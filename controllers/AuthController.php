<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    /**
     * Handles GET and POST requests to /login
     * return Login page to get
     * handles user login and redirect with message if successful, 
     *  redirect to login page with errors if not successful
     */
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();       //create new Login form
        if($request->isPost()){             //returns if request method is POST
            $loginForm->loadData($request->getBody());      ////get form data as array of ['attribute' => 'value']
            if($loginForm->validate() && $loginForm->login() ){     //validate form data against rules set in the LoginForm model and runs login method

                $response->redirect('/');   //if successful redirect to home
                return;
            }
        }

        //if GET
        $this->setLayout('auth');       //set page layout with controller method
        return $this->render('login',[  //return view with parameters
            'model' => $loginForm       //form model
        ]);
        
    }

    /**
     * Handles GET and POST requests to /register
     * return Register page if GET
     * handles user register and redirect with message if successful, 
     *  redirect to register page with errors if not successful
     */
    public function register(Request $request)
    {
        $user = new User();     //new user model instance

        if($request->isPost()){     //returns if method is POST
            $user = new User();     
            $user->loadData($request->getBody());   //get form data as array of ['attribute' => 'value']

            if($user->validate() && $user->save()){         //validate form data against rules set in the LoginForm model and runs login method
                Application::$app->session->setFlash('success', 'Thanks for registering');  //set flash message
                Application::$app->response->redirect('/');     //redirect to home
                exit;               //exit if no errors
            }

            //if GET
            return $this->render('register', [      //return register page with errors
                'model' => $user                    //model is user
            ]);

        }

        $this->setLayout('auth');
        return $this->render('register', [          //return register page
            'model' => $user                        //model is user
        ]);

    }
}
?>