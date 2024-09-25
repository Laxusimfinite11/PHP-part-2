<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h1>Word Frequency Counter</h1>

<form action="index.php" method="post">
    <label for="text">Paste your text here:</label>
    <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>

    <label for="sort">Sort by frequency:</label>
    <select id="sort" name="sort">
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
    </select><br><br>

    <label for="limit">Number of words to display:</label>
    <input type="number" id="limit" name="limit" value="10" min="1"><br><br>

    <input type="submit" value="Calculate Word Frequency">
</form>

<?php

function tokenizeText(string $text): array {
    $text = strtolower($text);
    $text = preg_replace('/[^\w\s]/u', '', $text);
    $words = preg_split('/\s+/', $text);
    return array_filter($words);
}

function calculateWordFrequency(array $words): array {
    $stopWords = ['the', 'and', 'in', 'on', 'at', 'of', 'is', 'a', 'an', 'with', 'to', 'for', 'it', 'by', 'from'];
    $filteredWords = array_diff($words, $stopWords);
    return array_count_values($filteredWords);
}

function sortWordFrequency(array $wordFrequencies, string $order = 'desc'): array {
    if ($order === 'asc') {
        asort($wordFrequencies);
    } else {
        arsort($wordFrequencies);
    }
    return $wordFrequencies;
}

function limitWordDisplay(array $wordFrequencies, int $limit): array {
    return array_slice($wordFrequencies, 0, $limit, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'] ?? '';
    $sortOrder = $_POST['sort'] ?? 'desc';
    $limit = (int)($_POST['limit'] ?? 10);

    if (empty($text)) {
        echo "Please provide some text to analyze.";
        exit;
    }

    $words = tokenizeText($text);
    $wordFrequencies = calculateWordFrequency($words);
    $sortedFrequencies = sortWordFrequency($wordFrequencies, $sortOrder);
    $limitedFrequencies = limitWordDisplay($sortedFrequencies, $limit);

    echo "<h2>Word Frequency Result:</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Word</th><th>Frequency</th></tr>";
    foreach ($limitedFrequencies as $word => $frequency) {
        echo "<tr><td>" . htmlspecialchars($word) . "</td><td>" . $frequency . "</td></tr>";
    }
    echo "</table>";
}
?>

</body>
</html>
