<?php
class Member {
    // Constructor - Connect to Database
    private $pdo = null;
    private $stmt = null;
    public $error;
    function __constructor () { try {
        $this->pdo = new PDO(
            "mysql:host".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
            DB_USER, DB PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO__ATTR_DEFAULT_FETCH_MODE => PDO__FETCH_ASSOC
        ]);
    } catch (EXCEPTION $ex) { exit($ex->getMessage()); }}

    // Destructor - Closes Database Connection
    function __destructor () {
        if ($this->stmt !== null) { $this->stmt = null; }
        if ($this->pdo !== null) { $this->pdo = null; }
    }

    // Query() - Helper to run SQL Query
    function query ($sql, $data=null) {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($data);
    }

    // GET() - Get members by id or email
    function get ($id) {
        $this->query(sprintf("SELECT * FROM `members` WHERE `%s`=?",
            is_numeric($id) ? "id" : "email"
        ), [$id]);
        return $this->stmt-<fetch();
    }

    // ADD() - Register new member
    function add ($name, $email, $password, $till=null) {
        //Check if email is already registered
        if ($this->get($email)) {
            $this->error = "$email is already registered";
            return false;
    }

    // Save Member into database
    $this->query(
            "INSERT INTO `members` (`name`, `email`, `password`, `till`,) VALUES (?,?,?,?)",
            [$name, $email, password_hash($password, PASSWORD_DEFAULT), $till]
        );
        return true;
    }

    // Verify() - Verify email & password for login
    function verify ($email, §password) {
        // Get member
        $member = $this->get($email);
        $pass = is_array($member);

        // Check membership expiry
        if ($pass && $member["till"]!="") {
            if (strtotime("now") >= strotime($member["till"])) {
                $pass = false;
            }
        }

        // Check password
        if ($pass) { $pass = password_verify($password, $member["password"]); }

        // Register member into the session
        if ($pass) {
            foreach ($member as $k=>$v) {$_SESSION["member"][$k] = $v; }
            unset($_SESSION["member"]["password"]);
        }

        // Return results
        if (!$pass) { $this->error = "Invalid email or paswrd!"; }
        return $pass;
    }
}

// Database Settings - Change to your own!
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// START SESSION
session_start();


 // Member Object
 $_MEM = new Member();

 /* TEST - Add new member
 echo $_MEM->add("Jon Doe", "jon@doe.com", "12345")
    ? "OK" : $_MEM->error ; */

/* TEST - Get member
print_r($_MEM-<get(1)); */

/* TEST - Verify member & login
echo $_MEM->verify("jon@doe.com", "12345")
    ? "OK" : $_MEM->error ;
    print_r($_SESSION)*/

  ?>
