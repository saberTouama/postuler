<?php

use Vonage\Client;
use App\Models\email;
use App\Models\offre;
use App\Events\MyEvent;
use App\Models\workowner;
use Vonage\SMS\Message\SMS;
use App\Http\Middleware\admin;
use App\Http\Middleware\isworkowner;
use Vonage\Client\Credentials\Basic;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Notifications\CandidateAccepted;
use App\Notifications\OffreNotification;

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\EmailController2;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::get('/offer mail',function(){
     $offre = offre::latest()->first();
  $emails=email::select('email');
    foreach($emails as $email){
    Notification::route('mail', $email)->notify(new OffreNotification($offre));}
});
Route::get('/send-test-sms', function () {
    $offer = offre::latest()->first();

    Notification::route('vonage', '123675518700')
        ->notify(new CandidateAccepted($offer));}
    );



Route::get('/test-cv-hf', function () {
    $cv = <<<EOT
John Doe is a backend developer with 5 years of experience in PHP, Laravel, MySQL, and RESTful APIs.
He has built and maintained Laravel apps and used Docker and Livewire.
EOT;

    $job = <<<EOT
We are hiring a Laravel backend developer with 3+ years of experience in PHP, MySQL, and API development.
EOT;

    $payload = [
        "inputs" => "Candidate CV: $cv\n\nJob Description: $job",
        "parameters" => [
            "candidate_labels" => ["match", "not_match", "neutral"]
        ]
    ];

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('HF_API_KEY'),
    ])->post("https://api-inference.huggingface.co/models/facebook/bart-large-mnli", $payload);

    $data = $response->json();

    if (isset($data['error'])) {
        return "<h3>❌ Error:</h3><pre>" . json_encode($data['error'], JSON_PRETTY_PRINT) . "</pre>";
    }

    return view('cv-result', ['data' => $data]);
});
Route::get('/mailing', [EmailController2::class,'store'])->name('mailing');

Route::get('/chat2',function(){
    return view('chat');
});
Route::get('/test',function(){
    return view('test');
});
//Route::get('/',function(){    return view('livewire.publishing');});
Route::get('/about',function(){
    return view('offre.about');
});
Route::get('/chat', 'ChatsController@index');

Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');


Route::get('/redis-test', function () {
    Cache::put('key', 'value', 600);
    return Cache::get('key');
});



Route::get('/welcome', function(){
    return view('welcome');
});



//});
Route::get('/chirp/index', [ChirpController::class, 'index'])->name('chirps.index');


//Route::get('/show', function(){    return view('offre.show');})->name('offre.show');

Route::resource('create', OffreController::class)
    ->middleware('isworkownr');

    Route::post('/delete-condidate', [WorkerController::class, 'destroy'])->name('worker.destroy');


Route::get('/workerindex', [WorkerController::class, 'index'])->name('worker.index');

Route::get('/search-offres', [OffreController::class, 'search'])->name('offre.search');
Route::post('/offre-destroy', [OffreController::class, 'destroy'])->name('offre.destroy');

Route::post('/cat', [OffreController::class, 'cat'])->name('offre.cat');
Route::get('/', [OffreController::class, 'index'])->name('offre.create');

Route::get('/offre-detaille/{offre}', [OffreController::class, 'show'])->name('offre.detaille');






Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/notify/{id}', [AuthenticatedSessionController::class, 'notify'])->name('notify');
    Route::get('/unnotify/{id}', [AuthenticatedSessionController::class, 'unnotify'])->name('unnotify');
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');


    Route::get('workerinput/{id}', [WorkerController::class, 'index'])->name('offre.workerinput');
    Route::post('/workerdata', [WorkerController::class, 'store'])->name('worker.store');

    Route::post('/chirp', [ChirpController::class, 'store'])->name('chirps.store');
Route::get('/chirp/edit/{chirp}', [ChirpController::class, 'edit'])->name('chirps.edit');
Route::patch('/chirp/update/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');
Route::post('/chirp/destroy/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');
Route::get('/notifications', function () {
    return view('notifications');
});
Route::get('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

Route::middleware([isworkowner::class])->group(function () {

    Route::post('/step1', [OffreController::class,'step1'])->name('offre.step1');
    Route::post('/step2', [OffreController::class,'step2'])->name('offre.step2');
    Route::post('/step3', [OffreController::class,'step3'])->name('offre.step3');
    Route::post('/store-offres', [OffreController::class,'store'])->name('offre.store');
    Route::get('/publish', [OffreController::class, 'create'])//->middleware('isworkowner')

    ->name('publish');
    Route::get('/youroffres/{id}', [OffreController::class, 'display'])->name('offre.youroffres');
    Route::get('/show/{id}', [WorkerController::class, 'mydisplay'])->name('offre.show');
    Route::post('/accept-condidate', [WorkerController::class, 'accept'])->name('worker.accept');
});
Route::middleware([admin::class])->group(function () {
    Route::post('add tool',[ToolController::class, 'store'])->name('tool.store');
    Route::post('add catigory',[CategoryController::class, 'store'])->name('catigory.store');
    Route::get('/cancel offer/{id}', [OffreController::class, 'cancel'])->name('offre.cancel');
    Route::get('/republish offer/{id}', [OffreController::class, 'republish'])->name('offre.republish');
    Route::get('/manage-offers', [OffreController::class, 'all'])->name('offre.all');
    Route::get('/advenced cv filter', [WorkerController::class, 'all'])->name('cvs');
    Route::get('/set as filtred/{id}', [WorkerController::class, 'filtred'])->name('filtred');
    Route::get('all-users', [AuthenticatedSessionController::class, 'all'])
                ->name('all-users');
                Route::get('/editoffre/{offre}', [OffreController::class, 'edit'])->name('offre.edit');
Route::patch('/update-offres/{offre}', [OffreController::class, 'update'])->name('offre.update');
Route::get('accept-workowner/{id}', [AuthenticatedSessionController::class, 'accept'])
                            ->name('accept');
                            Route::post('/delete_user', [ProfileController::class, 'delete_user'])->name('profile.delete_user');
});

            Route::middleware('guest')->group(function () {
                Route::get('/login', function(){
                    return view('auth.login');
                });
                Route::get('/register', [RegisteredUserController::class, 'index'])
                            ->name('register');



                Route::get('login.store', [AuthenticatedSessionController::class, 'store']);

                Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                            ->name('password.request');

                Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                            ->name('password.email');

                Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                            ->name('password.reset');

                Route::post('reset-password', [NewPasswordController::class, 'store'])
                            ->name('password.store');
            });
            Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::patch('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
require __DIR__.'/auth.php';
/*  "sqlite": {
			"databasePath": "/database/laravel-echo-server.sqlite"
		}*/
