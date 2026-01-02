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

        // Vérification du type MIME
        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, $this->allowedTypes)) {
            return null;
        }

        // Nom d’origine sans extension
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);

        // Nettoyage du nom (accents, espaces, caractères spéciaux)
        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);

        // 🔥 Petit suffixe aléatoire (4 caractères)
        $suffix = substr(bin2hex(random_bytes(2)), 0, 4);

        // Nom final
        $finalName = $safeName . '_' . $suffix;

        // Dossier de destination
        $uploadDir = __DIR__ . '/../../public/assets/uploads/' . $folder . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        // Chemin final WebP
        $webpPath = $uploadDir . $finalName . '.webp';

        // Redimensionnement + conversion WebP
        if (!$this->resizeAndConvertToWebp($file['tmp_name'], $webpPath)) {
            return null;
        }

        // Retourne le chemin web
        return '/assets/uploads/' . $folder . '/' . $finalName . '.webp';
    }

    private function resizeAndConvertToWebp(string $srcPath, string $destPath): bool
    {
        list($width, $height) = getimagesize($srcPath);
        $ratio = $height / $width;

        $newWidth  = min($width, $this->maxWidth);
        $newHeight = (int) ($newWidth * $ratio);

        $src = imagecreatefromstring(file_get_contents($srcPath));
        if (!$src) return false;

        $dst = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Conversion en WebP
        imagewebp($dst, $destPath, $this->quality);

        imagedestroy($src);
        imagedestroy($dst);

        return true;
    }
}
