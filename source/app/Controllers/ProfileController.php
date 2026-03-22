<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class ProfileController extends Controller {

    public function index() {
        $this->requireLogin();
        $this->view('profile/index',[
            'title' => 'Hồ sơ cá nhân'
        ]);
    }

    public function updateInfo() {
        if (!isset($_SESSION['user'])) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 401);
            return;
        }

        $userId = $_SESSION['user']->id;
        $fullname = $_POST['fullname'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $avatarPath = $_SESSION['user']->avatar; 
        
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            try {
                $avatarPath = $this->handleFileUpload($_FILES['avatar'], 'avatar_' . $_SESSION['user']->id . '_');
            } catch (Exception $e) {
                $this->json(['success' => false, 'message' => $e->getMessage()]);
                return;
            }
        }
        
        $userModel = new User();
        $userModel->updateProfile($userId, $fullname, $avatarPath, $phone);
        
        $_SESSION['user']->fullname = $fullname;
        $_SESSION['user']->phone = $phone;
        $_SESSION['user']->avatar = $avatarPath;

        $this->json(['success' => true, 'message' => 'Cập nhật hồ sơ thành công!']);
    }

    public function changePassword() {
        if (!isset($_SESSION['user'])) {
            $this->json(['success' => false], 401); return;
        }

        $userId = $_SESSION['user']->id;
        $currentPass = $_POST['current_password'] ?? '';
        $newPass = $_POST['new_password'] ?? '';
        if (empty($newPass)) {
             $this->json(['success' => false, 'message' => 'Vui lòng nhập mật khẩu mới']);
             return;
        }

        $userModel = new User();
        $user = $userModel->find($userId);
        if (!password_verify($currentPass, $user->password)&& $currentPass !== $user->password) {
            $this->json(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng.']);
            return;
        }

        $newHash = password_hash($newPass, PASSWORD_DEFAULT);
        $userModel->updatePassword($userId, $newHash);

        $this->json(['success' => true, 'message' => 'Đổi mật khẩu thành công!']);
    }
}