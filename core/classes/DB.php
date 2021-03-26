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

	public function tableExists(string $table): bool{
		$conn = $this->getConn();

		try {
			$result = $conn->query("SELECT 1 FROM ${table} LIMIT 1");
		} catch (Exception $e) {
			return false;
		}

		return $result !== false;
	}

	public function currencyExists(string $currencyId): bool{
		$conn = $this->getConn();
		$stmt = $conn->prepare("SELECT name FROM currency WHERE id = :id");
		$stmt->bindParam(":id", $currencyId);
		$stmt->execute();

		return $stmt->rowCount() > 0;
	}

	public function getCurrencies(): array{
		$conn = $this->getConn();
		$stmt = $conn->prepare("SELECT * FROM currency");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getCurrency(string $currencyId): array{
		$conn = $this->getConn();
		$stmt = $conn->prepare("SELECT * FROM currency WHERE id = :id");
		$stmt->bindParam(":id", $currencyId);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function editCurrency(array $data): bool{
		$conn = $this->getConn();
		$stmt = $conn->prepare("UPDATE currency SET name = :name, symbol = :symbol, symbol_position = :sym_pos, starting_amount = :st_amt, maximum_amount = :max_amt WHERE id = :id");
		$stmt->bindParam(":id", $data["id"]);
		$stmt->bindParam(":name", $data["name"]);
		$stmt->bindParam(":symbol", $data["symbol"]);
		$stmt->bindParam(":sym_pos", $data["symbol_position"]);
		$stmt->bindParam(":st_amt", $data["starting_amount"]);
		$stmt->bindParam(":max_amt", $data["maximum_amount"]);

		return $stmt->execute();
	}

	// check if the currency exists before adding
	public function addCurrency(array $data): bool{
		$conn = $this->getConn();
		$stmt = $conn->prepare("INSERT INTO currency (id, name, symbol, symbol_position, starting_amount, maximum_amount) VALUES (:id, :name, :symbol, :sym_pos, :st_amt, :max_amt)");
		$stmt->bindParam(":id", $data["id"]);
		$stmt->bindParam(":name", $data["name"]);
		$stmt->bindParam(":symbol", $data["symbol"]);
		$stmt->bindParam(":sym_pos", $data["symbol_position"]);
		$stmt->bindParam(":st_amt", $data["starting_amount"]);
		$stmt->bindParam(":max_amt", $data["maximum_amount"]);

		return $stmt->execute();
	}

	public function deleteCurrency(string $currencyId): bool{
		$conn = $this->getConn();
		$stmt = $conn->prepare("DELETE FROM currency WHERE id = :id");
		$stmt->bindParam(":id", $currencyId);

		return $stmt->execute();
	}
}