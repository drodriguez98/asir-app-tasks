<?php include("config.php"); ?>		

<?php

	# Conexión a la base de datos

	function connectDatabase() {
		
		try {
		
			$connection = new PDO("mysql:host=".HOST."; dbname=".DBNAME."; charset=utf8", USER, PASSWORD);	
			$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		} catch (PDOException $e) {		
			
			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
	
		}
		
		return $connection;
		
	} 

	# Finalizar conexión 

	function disconnectDatabase ($connection) { $connection = NULL; }

	# Insertar tarea 

	function insertTask ($name, $description, $priority) {
		
		$connection = connectDatabase();
		
		try {		
			
			$sql = "INSERT INTO tasks (name, description, priority) VALUES (:name, :description, :priority)";	
			$stmt = $connection -> prepare($sql);
			$stmt -> bindParam(':name', $name);
			$stmt -> bindParam(':description', $description);
			$stmt -> bindParam(':priority', $priority);
			$stmt -> execute();
			
		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;

		}
		
		$taskId = $connection -> lastInsertId();
		disconnectDatabase($connection);
		return $taskId;	 
		
	}

	# Actualizar tarea
		
	function updateTask($taskId, $name, $description, $priority) {

		$conexion = connectDatabase();

		try {		

			$sql = "UPDATE tasks SET name = :name, description = :description, priority = :priority WHERE taskId = :taskId"; 	
			$stmt = $conexion -> prepare($sql);
			$stmt -> bindParam(':taskId', $taskId);
			$stmt -> bindParam(':name', $name);
			$stmt -> bindParam(':description', $description);
			$stmt -> bindParam(':priority', $priority);
			$stmt -> execute();

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}

		$numRows = $stmt -> rowCount();
		disconnectDatabase($conexion);
		return $numRows;	

	} 

	# Seleccionar tarea

	function selectTask($taskId) {

		$connection = connectDatabase();

		try {		

			$sql = "SELECT * FROM tasks WHERE taskId = :taskId";  
			$stmt = $connection -> prepare($sql);
			$stmt -> bindParam(':taskId', $taskId);
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);		

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;

		}

		disconnectDatabase($connection);
		return $row;		

	}

	# Borrar tarea

	function deleteTask($taskId) {
		
		$connection = connectDatabase();
		
		try {
			
			$sql = "DELETE FROM tasks WHERE taskId = :taskId";	
			$stmt = $connection -> prepare($sql);			
			$stmt -> bindParam(':taskId', $taskId);
			$stmt -> execute();
			
		} catch (PDOException $e) {		
			
			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}
		
		$numRows = $stmt -> rowCount();
		disconnectDatabase($connection);
		return $numRows;	
		
	}

	# Inicio de sesión

	function login ($username, $password) {		

		$connection = connectDatabase();

		try {			

			$sql = "SELECT * FROM users WHERE username = :username";  
			$stmt = $connection -> prepare($sql);
			$stmt -> bindParam(':username', $username);
			$stmt -> execute();
			$row = $stmt -> fetch (PDO::FETCH_ASSOC);

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}

		return password_verify ($password, $row['password']);		

	}

	# Paginación: mostrar x tareas por página

	function pagination ($firstTaskOfPage, $numElements) {

		$connection = connectDatabase();

		try {

			$sql = "SELECT * from tasks LIMIT :firstTaskOfPage, :numElements";
			$stmt = $connection -> prepare($sql);
			$stmt -> bindParam(':firstTaskOfPage', $firstTaskOfPage, PDO::PARAM_INT);
			$stmt -> bindParam(':numElements',  $numElements, PDO::PARAM_INT);	
			$stmt -> execute();
			$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);		

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}
		
		disconnectDatabase($connection);
		return $rows;		
	
	}

	# Calcular el número de páginas a crear 

	function numPages ($numElements) {

		$connection = connectDatabase();

		try {	

			$sql = "SELECT count(*) FROM tasks";
			$numTasks = $connection -> query($sql) -> fetchColumn();

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}

		$numPages = ceil ($numTasks / $numElements);
		disconnectDatabase($connection);
		return $numPages;		

	} 


	# Registro.

	function register ($name, $username, $password) {

		$connection = connectDatabase();
		$password = password_hash ($password, PASSWORD_BCRYPT);

		try { 

			$sql = "INSERT INTO users (name, username, password) VALUES (:name, :username, :password)";	
			$stmt = $connection -> prepare($sql);
			$stmt -> bindParam(':name', $name);
			$stmt -> bindParam(':username', $username);
			$stmt -> bindParam(':password',  $password);	
			$stmt -> execute();
		
		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}

		$numRows = $stmt -> rowCount();
		disconnectDatabase ($connection);
		return $numRows; 

	}

	#	Comprobar que no existe ningun usuario con el nombre introducido durante el registro. 

	function selectUser ($username) {

		$conexion = connectDatabase();

		try { 

			$sql = "SELECT * FROM users WHERE username = :username";
			$stmt = $conexion -> prepare($sql);
			$stmt -> bindParam(':username', $username);
			$stmt -> execute();
		
		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}

		$numRows = $stmt -> rowCount();
		disconnectDatabase($conexion);
		return $numRows; 

	}

	#	No se usa porque usamos paginación y no se muestran todas las tareas en una sóla página.

	function selectAllTasks() {

		$connection = connectDatabase();

		try {		

			$sql = "SELECT * FROM tasks";  
			$stmt = $connection -> query($sql);
			$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);		

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
		}
		
		disconnectDatabase($connection);
		return $rows;		

	}

?>