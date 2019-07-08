<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NotifyAdmin;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Exception;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Void_;

class Homecontroller extends Controller
{
    public function Index()
    {
        $data = [];
        $data['current_time'] = date('Y M D, H:i:s');
        $data['sites_title'] = 'LLC Blog';
        $data['links'] = [
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'google' => 'https://google.com',
            'youtube' => 'https://youtube.com',
            'linkedIn' => 'https://linkedIn.com',
        ];
//        check if data exists in cache
//        show from cache
//        if not exists, query from database
        $data['articles'] = cache('articles', function () {
            return Post::with('user', 'category')->orderBy('created_at', 'desc')->take(50)->get();
        });
//        $data['articles'] = Post::with('user', 'category')->orderBy('created_at', 'desc')->paginate(10);

        return view('about', $data);
    }

    public function showAbout()
    {
        return view('contact');
    }

    public function post()
    {
        $data = [];
        $data['current_time'] = date('Y M D, H:i:s');
        $data['sites_title'] = 'LLC Blog';
        $data['links'] = [
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'google' => 'https://google.com',
            'youtube' => 'https://youtube.com',
            'linkedIn' => 'https://linkedIn.com',
        ];
        $data['post'] = [
            'title' => 'This is a simple post',
            'create_at' => 'January 2,2014',
            'description' => ' <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
        <hr>
        <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
        <blockquote>
          <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </blockquote>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <h2>Heading</h2>
        <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <h3>Sub-heading</h3>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        <pre><code>Example code block</code></pre>
        <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
        <h3>Sub-heading</h3>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>'
        ];
        return view('post', $data);
    }

    public function showRegistrationFrom()
    {
        $data = [];
        $data['current_time'] = date('Y M D, H:i:s');
        $data['sites_title'] = 'LLC Blog';
        $data['links'] = [
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'google' => 'https://google.com',
            'youtube' => 'https://youtube.com',
            'linkedIn' => 'https://linkedIn.com',
        ];
        return view('register', $data);
    }

    public function showprocessRegistration(Request $request)
    {
        $this->validate($request, [
            //validation
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:6|max:13|unique:users,phone_number',
            'photo' => 'required|image|max:10240',
            'password' => 'required|min:6|confirmed',
        ]);

        $photo = $request->file('photo');
        $file_name = uniqid('photo_', true) . str_random(10) . '.' . $photo->getClientOriginalExtension();
        if ($photo->isValid()) {
            $photo->storeAs('images', $file_name);
        }
        $user = User::create([
            'full_name' => $request->input('full_name'),
            'email' => strtolower($request->input('email')),
            'phone_number' => $request->input('phone_number'),
            'photo' => $request->input('photo', $file_name),
            'password' => bcrypt($request->input('password')),
            'email_verification_token' => str_random(32)
        ]);
        //use mail
//        Mail::to($user->email)->send(new VerificationEmail($user));

//        use by queue
//        Mail::to($user->email)->queue(new VerificationEmail($user));

        //use notification
//        $user->notify(new VerifyEmail($user));

//        use database notification
        $user->notify(new VerifyEmail($user));
        $admin = User::find(1);
        $admin->notify(new NotifyAdmin($user));


        try {


            $this->setSuccessMessage('Your account create successful');
            return redirect()->route('login');
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            return redirect()->back();
        }


//        $validator = Validator::make($request->all(), [
//            'full_name' => 'required',
//            'email' => 'required|email|unique:users,email',
//            'phone_number' => 'required|min:6|max:13|unique:users,phone_number',
//            'password' => 'required|min:6|confirmed',
//        ]);
//        if ($validator->fails()) {
//            return redirect()->back()->withErrors($validator)->withInput();
//        }

//    public function showUser($id,$name=''){
//        echo $id.' '. $name;
//    }

    }

    public function showLoginFrom()
    {
        $data = [];
        $data['current_time'] = date('Y M D, H:i:s');
        $data['sites_title'] = 'LLC Blog';
        $data['links'] = [
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'google' => 'https://google.com',
            'youtube' => 'https://youtube.com',
            'linkedIn' => 'https://linkedIn.com',
        ];
        return view('login', $data);
    }

    public function processLoginFrom(Request $request)
    {
        //validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $user->last_login = Carbon::now();
            $user->save();

            if ($user->email_verified === 0) {
                session()->flash('type', 'danger');
                session()->flash('message', 'Your account is not activated. Please verify your email');
                auth()->logout();
                return redirect()->route('login');
            }
            return redirect()->route('home');
        }

        $this->setErrorMessage('Invalid credentials.');

        return redirect()->back();
    }
//        $this->validate($request,[
//           'email'=>'required|email',
//            'password'=>'required|password'
//        ]);
//        $credentials=$request->except(['_token']);
//        if (auth()->attempt($credentials)){
//            return redirect()->route('home');
//        }
//        $this->setErrorMessage('Invalid credentials');
//        return redirect()->back();
    public function showHome()
    {
        $data = [];
        $data['current_time'] = date('Y M D, H:i:s');
        $data['sites_title'] = 'LLC Blog';
        $data['links'] = [
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'google' => 'https://google.com',
            'youtube' => 'https://youtube.com',
            'linkedIn' => 'https://linkedIn.com',
        ];
        $data['user'] = auth()->user();
        return view('home', $data);
    }


    public function Logout()
    {
        auth()->logout();
        $this->setSuccessMessage('user has been logged out');
        return redirect()->route('login');
    }

    public function verifyEmail($token)
    {
        if ($token === null) {
            session()->flash('type', 'warning');
            session()->flash('message', 'Invalid token');

            return redirect()->route('login');
        }

        $user = User::where('email_verification_token', $token)->first();
        if ($user === null) {
            session()->flash('type', 'warning');
            session()->flash('message', 'Invalid token');

            return redirect()->route('login');
        }

        $user->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => '',
        ]);

        session()->flash('type', 'success');
        session()->flash('message', 'Your account is activated. You can login now');

        return redirect()->route('login');
    }
}

