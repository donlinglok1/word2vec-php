# PHP-word2vec

This project is basic on google word2vec trunk https://code.google.com/archive/p/word2vec/

## Installation
1. Move the files inside `var/www/html` to your path.
2. Add below code to your .php file.
```php
<?php include 'word2vec.php';?>
```
3. Use the function inside the `word2vec.php`.
```php
<?php
// if you want to train your own bin
train (...);

// run word2vec
distance (...);
?>
```
4. You should also consider changing the path or managing folder permission for security reasons.

## Demo
0. Install `docker` and `docker-compose` on your machine.
1. Download this project, go to the project directory and run.
```bash
docker-compose up
```
2. go to `http://localhost:8088/`, and you should see the result of word2vec.

## Simple
### distance
1. run `distance` with bin and keyword
```php
<?php
    print_r(distance ( dirname ( __FILE__ ) . "/questions-words_vectors.bin", "good" ));
    print_r(distance ( dirname ( __FILE__ ) . "/questions-words_vectors.bin", "bad" )); 
?>
```
2. result as below
```php
    Array
(
    [0] => sharpest,0.706261
    [1] => widest,0.699204
    [2] => highest,0.695929
    [3] => shortest,0.693608
    ...
)
Array
(
    [0] => sweet,0.721250
    [1] => dark,0.716362
    [2] => strangest,0.712229
    [3] => darkest,0.706598
   ...
)
```


### word_analogy
1. run `word_analogy` with bin and three keywords
```php
<?php
    print_r(word_analogy ( dirname ( __FILE__ ) . "/questions-words_vectors.bin", "good", "bad", "hot" ));
?>
```
2. result as below
```php
Array
(
    [0] => youngest,0.972688
    [1] => biggest,0.970707
    [2] => largest,0.968398
    [3] => cheaper,0.968350
    ...
)
```

### train
1. run `train` with text file
```php
<?php
    train ( dirname ( __FILE__ ) . "/google-word2vec-trunk/questions-words.txt" );
?>
```
