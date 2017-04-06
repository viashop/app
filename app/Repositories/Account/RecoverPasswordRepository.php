<?php

namespace Vialoja\Repositories\Account;

use Vialoja\Contracts\Repositories\Account\RecoverPasswordRepositoryInterface;
use Vialoja\Events\Emails\EventNotifyResetPassword;
use Vialoja\Events\Emails\EventNotifyUserRecoverPassword;
use Vialoja\Events\Logs\User\EventActivityRecordUserRecoverPassword;
use Vialoja\Events\Logs\User\EventActivityRecordUserResetPassword;
use Vialoja\Http\Requests\Account\RecoverPasswordRequest;
use Vialoja\Http\Requests\Account\ResetPasswordRequest;
use Vialoja\Models\User;
use Vialoja\Models\UserRecoverPassword;
use Vialoja\Traits\Filters\ValidatePassword;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use stdClass;


/**
 * Class RecoverPasswordRepository
 * @package Vialoja\Repositories\Account
 */
class RecoverPasswordRepository implements RecoverPasswordRepositoryInterface
{

    use ValidatePassword;

    /**
     * @var User
     */
    private $user;

    /**
     * @var UserRecoverPassword
     */
    private $recover;


    /**
     * RecoverPasswordRepository constructor.
     * @param User $user
     * @param UserRecoverPassword $recover
     */
    public function __construct(User $user, UserRecoverPassword $recover)
    {
        $this->user = $user;
        $this->recover = $recover;
    }

    /**
     * Check Exists Token
     * @param Request $request
     * @return mixed
     */
    public function isTokenResetPassord(Request $request)
    {

        $date = new DateTime(date('Y-m-d H:i:s'));
        $date->sub(new DateInterval('P1D'));
        $this->recover->where('created_at', '<=', $date->format('Y-m-d H:i:s'))->delete();
        return $this->recover->where('token', '=', $request->route('token'))->exists();

    }

    /**
     * Recover Password User
     * @param RecoverPasswordRequest $request
     */
    public function recoverPassword(RecoverPasswordRequest $request)
    {

        $user = $this->user->where('email', $request->email)->first();
        $this->recover->where('user_id',$user->id)->delete();

        $recover = $this->recover->create([
            'email' => $request->email,
            'user_id' => $user->id,
            'token' => sha1( uniqid( microtime() ) )
        ]);

        $stdClass = new stdClass();
        $stdClass->old = $user;
        $stdClass->new = $recover;

        event( new EventActivityRecordUserRecoverPassword( $stdClass ) );
        event( new EventNotifyUserRecoverPassword( $stdClass ) );


    }


    /**
     * Reset Password User
     * @param ResetPasswordRequest $request
     * @return bool
     */
    public function resetPassword(ResetPasswordRequest $request)
    {

        $this->isPasswordValid($request->password);

        $token = $request->route('token');
        $recover = $this->recover->select('user_id')->where('token', '=',$token)->first();

        $user = $this->user->findOrFail($recover->user_id);

        $this->user->where('id', $user->id)
            ->update([
                'password' => bcrypt( $request->password )
            ]);

        $stdClass = new stdClass();
        $stdClass->new = $user;

        event( new EventActivityRecordUserResetPassword( $stdClass ) );
        event( new EventNotifyResetPassword( $stdClass ) );

        return $this->recover->where('token', '=', $token)->delete();

    }

}
