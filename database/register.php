<?php
// register.php - Backend untuk registrasi event olahraga

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'sportvenue');
define('DB_USER', 'root');
define('DB_PASS', '');

class EventRegistration {
    private $pdo;
    
    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            $this->sendError('Database connection failed: ' . $e->getMessage(), 500);
        }
    }
    
    public function handleRequest() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->sendError('Method not allowed', 405);
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->sendError('Invalid JSON data', 400);
            }
            
            $this->registerEvent($input);
            
        } catch (Exception $e) {
            $this->sendError('Internal server error: ' . $e->getMessage(), 500);
        }
    }
    
    private function registerEvent($data) {
        // Validate required fields
        $errors = $this->validateInput($data);
        if (!empty($errors)) {
            $this->sendError('Validation failed', 400, $errors);
        }
        
        // Check for duplicate registration
        if ($this->isDuplicateRegistration($data)) {
            $this->sendError('Anda sudah terdaftar pada event ini dengan email atau nomor telepon yang sama', 409);
        }
        
        // Generate registration code
        $registrationCode = $this->generateRegistrationCode();
        
        // Insert registration
        $sql = "INSERT INTO registrations (
                    event_id, full_name, email, phone, payment_method, 
                    registration_code, registration_date, status
                ) VALUES (?, ?, ?, ?, ?, ?, NOW(), 'pending')";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $data['eventId'],
                trim($data['fullName']),
                strtolower(trim($data['email'])),
                trim($data['phone']),
                $data['paymentMethod'],
                $registrationCode
            ]);
            
            $this->sendSuccess([
                'code' => $registrationCode,
                'message' => 'Pendaftaran berhasil',
                'registration_id' => $this->pdo->lastInsertId()
            ]);
            
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // Duplicate entry
                $this->sendError('Data sudah terdaftar sebelumnya', 409);
            } else {
                $this->sendError('Database error: ' . $e->getMessage(), 500);
            }
        }
    }
    
    private function validateInput($data) {
        $errors = [];
        
        // Event ID
        if (empty($data['eventId']) || !is_numeric($data['eventId'])) {
            $errors[] = 'Event ID tidak valid';
        }
        
        // Full Name
        if (empty($data['fullName']) || strlen(trim($data['fullName'])) < 2) {
            $errors[] = 'Nama lengkap minimal 2 karakter';
        }
        
        // Email
        if (empty($data['email'])) {
            $errors[] = 'Email wajib diisi';
        } elseif (!filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid';
        }
        
        // Phone
        if (empty($data['phone'])) {
            $errors[] = 'Nomor telepon wajib diisi';
        } elseif (!preg_match('/^\+?\d{8,15}$/', preg_replace('/\s/', '', trim($data['phone'])))) {
            $errors[] = 'Nomor telepon tidak valid (8-15 digit)';
        }
        
        // Payment Method
        $validPaymentMethods = ['transfer_bank', 'credit_card', 'e_wallet', 'qris'];
        if (empty($data['paymentMethod']) || !in_array($data['paymentMethod'], $validPaymentMethods)) {
            $errors[] = 'Metode pembayaran tidak valid';
        }
        
        return $errors;
    }
    
    private function isDuplicateRegistration($data) {
        $sql = "SELECT COUNT(*) FROM registrations 
                WHERE event_id = ? AND (email = ? OR phone = ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['eventId'],
            strtolower(trim($data['email'])),
            trim($data['phone'])
        ]);
        
        return $stmt->fetchColumn() > 0;
    }
    
    private function generateRegistrationCode() {
        return 'REG' . date('Ymd') . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }
    
    private function sendSuccess($data) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'data' => $data
        ] + $data);
        exit();
    }
    
    private function sendError($message, $code = 400, $errors = null) {
        http_response_code($code);
        $response = [
            'success' => false,
            'error' => $message
        ];
        
        if ($errors) {
            $response['errors'] = $errors;
        }
        
        echo json_encode($response);
        exit();
    }
}

// Initialize and handle request
try {
    $registration = new EventRegistration();
    $registration->handleRequest();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Server error occurred'
    ]);
}