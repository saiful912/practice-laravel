<!doctype html>
<html lang="en">
<body>
<div>
    <p>Dear {{$user->full_name}}</p>
    <p>Your account has been created, please click this following link ato activate your accounts!</p>
    <a href="{{route('verify',$user->email_verification_token)}}">
        {{route('verify',$user->email_verification_token)}}
    </a>

    <br/>
    <P>Thanks!</P>
</div>
</body>
</html>