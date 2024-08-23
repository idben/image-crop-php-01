<?php
if (isset($_POST["canvasImage"])) {
    $data = $_POST["canvasImage"];

    if (preg_match("/^data:image\/(\w+);base64,/", $data, $type)) {
        $data = substr($data, strpos($data, ",") + 1);
        $type = strtolower($type[1]);

        if (!in_array($type, ["jpg", "jpeg", "gif", "png"])) {
            throw new \Exception("無效的圖片格式");
        }

        $data = base64_decode($data);

        if ($data === false) {
            throw new \Exception("base64解譯失敗");
        }
    } else {
        throw new \Exception("圖片資料格式不符");
    }

    $filePath = "uploads/" . uniqid() . "." . $type;
    // 這裡就是接你學過的把檔案搬移到指定位置的部份
    if (file_put_contents($filePath, $data)) {
        echo "已上傳至: " . $filePath;
    } else {
        echo "上傳失敗！";
    }
} else {
    echo "沒有接收到圖片";
}
?>