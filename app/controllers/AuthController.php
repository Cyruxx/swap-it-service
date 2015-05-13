<?php

class AuthController extends BaseController
{
    public function index()
    {
        return $this->response->errorNotFound();
    }

    public function login()
    {
        try {
            // Login credentials
            $aCredentials = [
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
            ];

            // Authenticate the user
            $oUser = Sentry::authenticate($aCredentials, false);

            return $this->response->item($oUser, new UserTransformer);

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return $this->response->error('E-Mail Adresse ist erforderlich.', 200);
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            return $this->response->error('Passwort ist erforderlich.', 200);
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            return $this->response->error('E-Mail oder Passwort falsch.', 200);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return $this->response->error('E-Mail oder Passwort falsch.', 200);
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            return $this->response->error('Benutzer ist nicht aktiviert.', 200);
        } // The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            return $this->response->error('Benutzer ist temporär ausgeschlossen.', 200);
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            return $this->response->error('Benutzer ist permanent ausgeschlossen.', 200);
        }
    }

    public function register()
    {
        try {
            // Create the user
            $oUser = Sentry::createUser([
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),
                'first_name' => Input::get('first_name'),
                'last_name'  => Input::get('last_name'),
                'activated'  => true,
            ]);

            // Find the group using the group id
            $oDefaultUserGroup = Sentry::findGroupById(3);

            // Assign the group to the user
            $oUser->addGroup($oDefaultUserGroup);

            Sentry::login($oUser, true);

            return $this->response->item($oUser, new UserTransformer($oUser));

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return $this->response->error('E-Mail Adresse ist erforderlich.', 200);
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            return $this->response->error('Passwort ist erforderlich.', 200);
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            return $this->response->error('Benutzer existiert bereits.', 200);
        } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
            return $this->response->error('Group not found', 200);
        }
    }

    public function logout()
    {
        Sentry::logout();
        return json_encode(['status_code' => 200, 'message' => 'Du wurdest erfolgreich abgemeldet.']);
    }
}