<?php
/**
 * Check for SHA1 string validity
 *
 * @param string $sha1 SHA1 string to validate
 * @return boolean Validity is ok or not
 */
function validate_is_sha1($sha1)
{
    return preg_match('/^[a-fA-F0-9]{40}$/', $sha1);
}

/**
 * Check for password validity
 *
 * @param string $passwd Password to validate
 * @param int $size
 * @return boolean Validity is ok or not
 */
function validate_is_passwd($passwd, $size = 6)
{
    return (tools_strlen($passwd) >= $size && tools_strlen($passwd) < 255);
}

/**
 * Check password commons
 * @param  string $pass password
 * @return bool true or false
 */
function validate_is_weak_password($pass)
{

    $array = array('111111', '11111111', '112233', '121212', '123123', '123456', '1234567', '12345678', '131313', '232323', '654321', '666666', '696969', '777777', '7777777', '8675309', '987654', 'aaaaaa', 'abc123', 'abc123', 'abcdef', 'abgrtyu', 'access', 'access14', 'action', 'albert', 'alexis', 'amanda', 'amateur', 'andrea', 'andrew', 'angela', 'angels', 'animal', 'anthony', 'apollo', 'apples', 'arsenal', 'arthur', 'asdfgh', 'asdfgh', 'ashley', 'asshole', 'august', 'austin', 'badboy', 'bailey', 'banana', 'barney', 'baseball', 'batman', 'beaver', 'beavis', 'bigcock', 'bigdaddy', 'bigdick', 'bigdog', 'bigtits', 'birdie', 'bitches', 'biteme', 'blazer', 'blonde', 'blondes', 'blowjob', 'blowme', 'bond007', 'bonnie', 'booboo', 'booger', 'boomer', 'boston', 'brandon', 'brandy', 'braves', 'brazil', 'bronco', 'broncos', 'bulldog', 'buster', 'butter', 'butthead', 'calvin', 'camaro', 'cameron', 'canada', 'captain', 'carlos', 'carter', 'casper', 'charles', 'charlie', 'cheese', 'chelsea', 'chester', 'chicago', 'chicken', 'cocacola', 'coffee', 'college', 'compaq', 'computer', 'cookie', 'cooper', 'corvette', 'cowboy', 'cowboys', 'crystal', 'cumming', 'cumshot', 'dakota', 'dallas', 'daniel', 'danielle', 'debbie', 'dennis', 'diablo', 'diamond', 'doctor', 'doggie', 'dolphin', 'dolphins', 'donald', 'dragon', 'dreams', 'driver', 'eagle1', 'eagles', 'edward', 'einstein', 'erotic', 'extreme', 'falcon', 'fender', 'ferrari', 'firebird', 'fishing', 'florida', 'flower', 'flyers', 'football', 'forever', 'freddy', 'freedom', 'fucked', 'fucker', 'fucking', 'fuckme', 'fuckyou', 'gandalf', 'gateway', 'gators', 'gemini', 'george', 'giants', 'ginger', 'golden', 'golfer', 'gordon', 'gregory', 'guitar', 'gunner', 'hammer', 'hannah', 'hardcore', 'harley', 'heather', 'helpme', 'hentai', 'hockey', 'hooters', 'horney', 'hotdog', 'hunter', 'hunting', 'iceman', 'iloveyou', 'internet', 'iwantu', 'jackie', 'jackson', 'jaguar', 'jasmine', 'jasper', 'jennifer', 'jeremy', 'jessica', 'johnny', 'johnson', 'jordan', 'joseph', 'joshua', 'junior', 'justin', 'killer', 'knight', 'ladies', 'lakers', 'lauren', 'leather', 'legend', 'letmein', 'letmein', 'little', 'london', 'lovers', 'maddog', 'madison', 'maggie', 'magnum', 'marine', 'marlboro', 'martin', 'marvin', 'master', 'matrix', 'matthew', 'maverick', 'maxwell', 'melissa', 'member', 'mercedes', 'merlin', 'michael', 'michelle', 'mickey', 'midnight', 'miller', 'mistress', 'monica', 'monkey', 'monkey', 'monster', 'morgan', 'mother', 'mountain', 'muffin', 'murphy', 'mustang', 'naked', 'nascar', 'nathan', 'naughty', 'ncc1701', 'newyork', 'nicholas', 'nicole', 'nipple', 'nipples', 'oliver', 'orange', 'packers', 'panther', 'panties', 'parker', 'password', 'password', 'password1', 'password12', 'password123', 'patrick', 'peaches', 'peanut', 'pepper', 'phantom', 'phoenix', 'player', 'please', 'pookie', 'porsche', 'prince', 'princess', 'private', 'purple', 'pussies', 'qazwsx', 'qwerty', 'qwertyui', 'rabbit', 'rachel', 'racing', 'raiders', 'rainbow', 'ranger', 'rangers', 'rebecca', 'redskins', 'redsox', 'redwings', 'richard', 'robert', 'rocket', 'rosebud', 'runner', 'rush2112', 'russia', 'samantha', 'sammy', 'samson', 'sandra', 'saturn', 'scooby', 'scooter', 'scorpio', 'scorpion', 'secret', 'sexsex', 'shadow', 'shannon', 'shaved', 'sierra', 'silver', 'skippy', 'slayer', 'smokey', 'snoopy', 'soccer', 'sophie', 'spanky', 'sparky', 'spider', 'squirt', 'srinivas', 'startrek', 'starwars', 'steelers', 'steven', 'sticky', 'stupid', 'success', 'suckit', 'summer', 'sunshine', 'superman', 'surfer', 'swimming', 'sydney', 'taylor', 'tennis', 'teresa', 'tereza', 'testes', 'tester', 'testing', 'theman', 'thomas', 'thunder', 'thx1138', 'tiffany', 'tigers', 'tigger', 'tomcat', 'toutcard', 'topgun', 'toyota', 'travis', 'trouble', 'trustno1', 'tucker', 'turtle', 'twitter', 'united', 'vagina', 'victor', 'victoria', 'viking', 'voodoo', 'voyager', 'walter', 'warrior', 'welcome', 'whatever', 'william', 'willie', 'wilson', 'winner', 'winston', 'winter', 'wizard', 'xavier', 'xxxxxx', 'xxxxxxxx', 'yamaha', 'yankee', 'yankees', 'yellow', 'zxcvbn', 'zxcvbnm', 'zzzzzz');
    $key = array_search($pass, $array);
    if (isset($key) && is_numeric($key)) {
        return false;
    } else {
        return true;
    }

}
