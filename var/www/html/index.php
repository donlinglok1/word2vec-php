<?php include 'word2vec.php';?>

<?php
// train ( dirname ( __FILE__ ) . "/google-word2vec-trunk/questions-words.txt" );
// train_phrase ( dirname ( __FILE__ ) . "/google-word2vec-trunk/questions-phrases.txt" );
?>

<pre>
    <?php
        print_r(distance ( dirname ( __FILE__ ) . "/questions-words_vectors.bin", "good" ));
        print_r(distance ( dirname ( __FILE__ ) . "/questions-words_vectors.bin", "bad" ));
        
        // need more memory
        // print_r(distance ( dirname ( __FILE__ ) . "/questions-phrases_vectors.bin", "good" ));
        // print_r(distance ( dirname ( __FILE__ ) . "/questions-phrases_vectors.bin", "bad" ));

        print_r(word_analogy ( dirname ( __FILE__ ) . "/questions-words_vectors.bin", "good", "bad", "hot" ));

        // may take time
        //print_r(compute_accuracy(dirname ( __FILE__ ) . "/questions-words_vectors.bin", 100));
    ?>
</pre>