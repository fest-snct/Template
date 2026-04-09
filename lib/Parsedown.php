<?php

class Parsedown
{
    public function text($text)
    {
        $text = str_replace(["\r\n", "\r"], "\n", trim((string) $text));
        if ($text === '') {
            return '';
        }

        $lines = explode("\n", $text);
        $html = [];
        $paragraph = [];
        $listItems = [];

        $flushParagraph = static function () use (&$paragraph, &$html) {
            if ($paragraph === []) {
                return;
            }

            $content = implode("<br>\n", array_map([self::class, 'parseInline'], $paragraph));
            $html[] = '<p>' . $content . '</p>';
            $paragraph = [];
        };

        $flushList = static function () use (&$listItems, &$html) {
            if ($listItems === []) {
                return;
            }

            $html[] = '<ul>';
            foreach ($listItems as $item) {
                $html[] = '<li>' . self::parseInline($item) . '</li>';
            }
            $html[] = '</ul>';
            $listItems = [];
        };

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '') {
                $flushParagraph();
                $flushList();
                continue;
            }

            if (preg_match('/^(#{1,6})\s+(.*)$/', $trimmed, $matches)) {
                $flushParagraph();
                $flushList();
                $level = strlen($matches[1]);
                $html[] = '<h' . $level . '>' . self::parseInline($matches[2]) . '</h' . $level . '>';
                continue;
            }

            if (preg_match('/^[-*]\s+(.*)$/', $trimmed, $matches)) {
                $flushParagraph();
                $listItems[] = $matches[1];
                continue;
            }

            if ($trimmed[0] === '<') {
                $flushParagraph();
                $flushList();
                $html[] = $line;
                continue;
            }

            $flushList();
            $paragraph[] = $trimmed;
        }

        $flushParagraph();
        $flushList();

        return implode("\n", $html);
    }

    private static function parseInline($text)
    {
        $text = htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/\[(.*?)\]\((.*?)\)/', '<a href="$2">$1</a>', $text);
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);

        return $text;
    }
}
