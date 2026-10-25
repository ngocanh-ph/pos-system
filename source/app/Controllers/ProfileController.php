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
        $this->requireLoginJson();

        $userId = $_SESSION['user']->id;
        $fullname = trim($_POST['fullname'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $oldAvatar = $_SESSION['user']->avatar;
        $avatarPath = $oldAvatar;

        if ($fullname === '' || mb_strlen($fullname) > 100) {
            $this->json(['success' => false, 'message' => 'Họ tên không được để trống và tối đa 100 ký tự.']);
        }
        if ($phone !== '' && !preg_match('/^\+?[0-9 .\-]{8,20}$/', $phone)) {
            $this->json(['success' => false, 'message' => 'Số điện thoại không hợp lệ.']);
        }

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            try {
                $avatarPath = $this->handleFileUpload($_FILES['avatar'], 'avatar_' . $userId . '_');
            } catch (Exception $e) {
                $this->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }

        (new User())->updateProfile($userId, $fullname, $avatarPath, $phone);

        if ($avatarPath !== $oldAvatar) {
            $this->deleteUpload($oldAvatar);
        }

        $_SESSION['user']->fullname = $fullname;
        $_SESSION['user']->phone = $phone;
        $_SESSION['user']->avatar = $avatarPath;

        $this->json(['success' => true, 'message' => 'Cập nhật hồ sơ thành công!']);
    }

    public function changePassword() {
        $this->requireLoginJson();

        $userId = $_SESSION['user']->id;
        $currentPass = (string)($_POST['current_password'] ?? '');
        $newPass = (string)($_POST['new_password'] ?? '');

        if (strlen($newPass) < 6) {
            $this->json(['success' => false, 'message' => 'Mật khẩu mới phải có ít nhất 6 ký tự.']);
        }

        $userModel = new User();
        $user = $userModel->find($userId);

        if (!$user || !$userModel->verifyPassword($user, $currentPass)) {
            $this->json(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng.']);
        }

        $userModel->updatePassword($userId, password_hash($newPass, PASSWORD_DEFAULT));
        session_regenerate_id(true);

        $this->json(['success' => true, 'message' => 'Đổi mật khẩu thành công!']);
    }
}
