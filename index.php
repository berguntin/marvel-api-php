<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tarea 9</title>
</head>
<body>
    <?php 
        /**
         * Dotenv secret variables config
         */
        use Dotenv\Dotenv;
        require __DIR__.'/vendor/autoload.php';
        /**
         * Loading dotenv file
         */
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load(); 
        /**
         * Secret variables
         */
        $API_PUBLIC = $_ENV["API_PUBLIC"];
        $API_PRIVATE = $_ENV["API_PRIVATE"];
        /**
         * Timestamp required at API call 
         */
        $date = date_create();
        $ts =date_timestamp_get($date);
        $key = md5($ts.$API_PRIVATE.$API_PUBLIC);
        /**
         * Calling API
         * 
         */
        $url = "https://gateway.marvel.com:443/v1/public/characters?limit=40&ts=$ts&apikey=f19ea43dcc7253f05ba422fa39cae31d&hash=$key";
        /**
         * Retrieving data from API
         */
        $data = file_get_contents($url);
        $JSON_data = json_decode($data);
        $results = $JSON_data->data->results;
        $atribution = $JSON_data->attributionHTML;

    ?>
    <header>
        <div class="logo"><image src='src/logo.png' width='150'></div>
    </header>
    <main>
        <span id='title'>
            <h1>Tarea 9 DWES</h1>
            <hr>
            <h2>Personajes de Marvel &trade;</h2>
        </span>
        <div class="results">
            <?php
                /**
                 * Iterate througt each character
                 * show image ant name 
                 */             
                foreach($results as $result){
                    $image = $result->thumbnail->path. '.' .$result->thumbnail->extension;
                    $name = $result->name;
                    echo   "<div class='comic'>
                            <div class='comic-image'>
                                <image src='{$image}' width='200'>
                            </div>
                            <span class='comic-title'>{$name}</span>
                            </div>";
                }
            ?>
        </div>
        <footer>
            <span>Hugo Bermudez || Tarea 9 DWES || Instituto FOC </span>
            <hr>
            <span id='copy'><?php echo $atribution ?></span>
        </footer>
    </main>
</body>
</html>