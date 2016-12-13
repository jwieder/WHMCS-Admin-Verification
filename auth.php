<?php 

/**
 * Include the WHMCS bootstrap file.
 * This ensure runtime access to WHMCS classes and libraries.
 *
 * NOTE: The bootstrap may generate output during early runtime observations,
 * like maintenance mode.
*/
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'init.php';

/**
* Call the WHMCS\Auth namespace which contains Auth() & related functions
*/
use WHMCS\Auth;

 if (!empty($_POST)) {
    /**
     * Might want to turn on output buffering in the event that another third-party
     * integration generates stray output
     */
    ob_start();
    
    $result = array('valid' => 0);
    /**
     * Acquire the credentials that need to be verified
     */
    $username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
    $password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
    /**
     * Determine if credentials are valid
     */
    try {
        if (!$username || !$password) {
            throw new RuntimeException(
                'Cannot validate an empty username or password'
            );
        }
        /**
         * Create an object instance of the admin authentication class
         */
        $adminAuth = new Auth();
        /**
         * Attempt to locate the admin, automatically hydrating the object with
         * details related to the admin on success.
         *
         * getInfobyUsername(username : string, [restrictToEnabled : bool = true])
         */
        if (!$adminAuth->getInfobyUsername($username)) {
            throw new RuntimeException(
                sprintf(
                    'No enabled admin found with username "%s"',
                    $username
                )
            );
        }
        /**
         * Verify the password for the provided user
         *
         * NOTE: your integration code is intended as a drop-in replacement for
         * includes/api.php, then you should use the compareApiPassword() method.
         *
         * comparePassword(string : password)
         */
        if ($adminAuth->comparePassword($password)) {
            $result['valid'] = 1;
        }
    } catch (Exception $e) {
        /**
         * Handle any exceptional conditions
         */
	      print_r($e);
    }
    /**
     * Turn off output buffering, if enabled
     */
    ob_end_clean();
    /**
     * Perform appropriate actions
     */
    if ($result['valid']) {
        /**
         * Credentials are valid
         * Perform success action here
         */
	      echo "Login Success";
    } else {
        /**
         * Credentials are NOT valid
         *
         * Perform failure action here
         */
	      echo "Login Failue";
    }
    Header('Content-Type: application/json; charset=UTF8');
    echo json_encode($result);
    exit();
}
