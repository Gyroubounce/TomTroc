<?php

class ImageManager {

    private array $allowedTypes;
    private int $maxWidth;
    private int $quality;

    public function __construct(
        array $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'],
        int $maxWidth = 800,
        int $quality = 80
    ) {
        $this->allowedTypes = $allowedTypes;
        $this->maxWidth = $maxWidth;
        $this->quality = $quality;
    }

    public function processUpload(array $file, string $folder): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, $this->allowedTypes)) {
            return null;
        }

        $basename = uniqid('img_', true);

        $uploadDir = __DIR__ . '/../../public/assets/uploads/' . $folder . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $resizedPath = $uploadDir . $basename . '.jpg';
        $webpPath    = $uploadDir . $basename . '.webp';

        if (!$this->resizeAndCompress($file['tmp_name'], $resizedPath)) {
            return null;
        }

        if (!$this->convertToWebp($resizedPath, $webpPath)) {
            return null;
        }

        unlink($resizedPath);

        return '/assets/uploads/' . $folder . '/' . $basename . '.webp';
    }

    private function resizeAndCompress(string $srcPath, string $destPath): bool
    {
        list($width, $height) = getimagesize($srcPath);
        $ratio = $height / $width;

        $newWidth  = min($width, $this->maxWidth);
        $newHeight = (int) ($newWidth * $ratio);

        $src = imagecreatefromstring(file_get_contents($srcPath));
        if (!$src) return false;

        $dst = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($dst, $destPath, $this->quality);

        imagedestroy($src);
        imagedestroy($dst);

        return true;
    }

    private function convertToWebp(string $srcPath, string $destPath): bool
    {
        $img = imagecreatefromstring(file_get_contents($srcPath));
        if (!$img) return false;

        imagewebp($img, $destPath, $this->quality);
        imagedestroy($img);

        return true;
    }
}
