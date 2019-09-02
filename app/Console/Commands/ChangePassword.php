<?php

namespace App\Console\Commands;

use App\User;
use App\Jobs\SendNewPasswordEmail;
use App\Models\Admin\Dealer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

// class SendEmails extends Command
class ChangePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newpswd:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new password to all dealer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dealers = Dealer::all();
        
        if (!empty($dealers)) {
            foreach ($dealers as $dealer) {
                $newpassword = rand(1000000,999999999);
                
                $dealer->password = encrypt($newpassword);
                $dealer->save();
                
                $user = User::find($dealer->id);
                $user->password = bcrypt($newpassword);;
                $user->save();
                
                dispatch(new SendNewPasswordEmail($dealer));
            }
        }
        
        Log::info('Update password.');


    }
}
