<?php
declare(strict_types = 1);

class DB{

	protected static $pdo = null;

	public function __construct(){
		if(self::$pdo === null){
			self::INIT();
		}
	}

	public static function CONN(): ?PDO{
		if(self::$pdo === null){
			self::INIT();
		}

		try {
			_log("Testing connection...");
			self::$pdo->query("SELECT 1");
		}
		catch (PDOException $e) {
			_log("Connection failed, reinitializing...");
			self::INIT();
		}

		return self::$pdo;
	}

	public static function INIT(): bool{
		$return = true;

		$host = $_SESSION["host"];
		$username = $_SESSION["username"];
		$password = $_SESSION["password"];
		$schema = $_SESSION["schema"];

		try{
			$pdo = new PDO("mysql:host=$host;dbname=$schema", $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			self::$pdo = $pdo;
		}
		catch(PDOException $e){
			$return = false;
			_log("Unable to establish connection. Error code: " . $e->getCode() . ".\nError message: " . $e->getMessage());
		}

		return $return;
	}

	public static function DESTROY(){
		self::$pdo = null;
	}

	public function getConn(): ?PDO{
		return self::CONN();
	}

	/*
	public function emailExists(string $email): bool{
		$stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
		$stmt->bindParam(":email", $email);
		$stmt->execute();

		return $stmt->rowCount() > 0;
	}

	public function usernameExists(string $username): bool{
		$stmt = $this->pdo->prepare("SELECT username FROM users WHERE username = :username");
		$stmt->bindParam(":username", $username);
		$stmt->execute();

		return $stmt->rowCount() > 0;
	}
	*/

	function tableExists(string $table): bool{
		$conn = $this->getConn();

		try {
			$result = $conn->query("SELECT 1 FROM ${table} LIMIT 1");
		} catch (Exception $e) {
			return false;
		}

		return $result !== false;
	}

	public function addCurrency(): void{
		$conn = $this->getConn();
		$stmt = $conn->prepare("");
	}
}