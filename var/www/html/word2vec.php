<?php

function train($textFilePath) {
	// WORD VECTOR estimation toolkit v 0.1c
	// Options:
	// Parameters for training:
	// 		-train <file>
	// 				Use text data from <file> to train the model
	// 		-output <file>
	// 				Use <file> to save the resulting word vectors / word clusters
	// 		-size <int>
	// 				Set size of word vectors; default is 100
	// 		-window <int>
	// 				Set max skip length between words; default is 5
	// 		-sample <float>
	// 				Set threshold for occurrence of words. Those that appear with higher frequency in the training data
	// 				will be randomly down-sampled; default is 1e-3, useful range is (0, 1e-5)
	// 		-hs <int>
	// 				Use Hierarchical Softmax; default is 0 (not used)
	// 		-negative <int>
	// 				Number of negative examples; default is 5, common values are 3 - 10 (0 = not used)
	// 		-threads <int>
	// 				Use <int> threads (default 12)
	// 		-iter <int>
	// 				Run more training iterations (default 5)
	// 		-min-count <int>
	// 				This will discard words that appear less than <int> times; default is 5
	// 		-alpha <float>
	// 				Set the starting learning rate; default is 0.025 for skip-gram and 0.05 for CBOW
	// 		-classes <int>
	// 				Output word classes rather than word vectors; default number of classes is 0 (vectors are written)
	// 		-debug <int>
	// 				Set the debug mode (default = 2 = more info during training)
	// 		-binary <int>
	// 				Save the resulting vectors in binary moded; default is 0 (off)
	// 		-save-vocab <file>
	// 				The vocabulary will be saved to <file>
	// 		-read-vocab <file>
	// 				The vocabulary will be read from <file>, not constructed from the training data
	// 		-cbow <int>
	// 				Use the continuous bag of words model; default is 1 (use 0 for skip-gram model)
	// Examples:
	// ./word2vec -train data.txt -output vec.txt -size 200 -window 5 -sample 1e-4 -negative 5 -hs 0 -binary 0 -cbow 1 -iter 3

	$train = $textFilePath;
	$output = dirname ( __FILE__ ) . "/".basename($textFilePath, ".txt")."_vectors.bin";
	$size = 500;
	$window = 5;
	$sample = 1e-3;
	$hs = 0;
	$negative = 5;
	$threads = 12;
	$iter = 5;
	$min_count = 5;
	$alpha = 0.025;
	$classes = 0;
	$debug = 2;
	$save_vocab = dirname ( __FILE__ ) . "/".basename($textFilePath, ".txt")."_save_vocab.txt";
	$read_vocab = dirname ( __FILE__ ) . "/".basename($textFilePath, ".txt")."_read_vocab.txt";
	$binary = 1;
	$cbow = 1;
	
	exec ( "cd ".dirname ( __FILE__ )."/google-word2vec-trunk "
	."&& ./word2vec -train {$train} -output {$output} "
	."-size {$size} "
	."-window {$window} "
	."-sample {$sample} "
	."-hs {$hs} "
	."-negative {$negative} "
	."-threads {$threads} "
	."-iter {$iter} "
	."-min-count {$min_count} "
	."-alpha {$alpha} "
	."-classes {$classes} "
	."-debug {$debug} "
	."-save-vocab {$save_vocab} "
	// ."-read-vocab {$read_vocab} "
	."-binary {$binary} "
	."-cbow {$cbow} "
	, $outputArray );

	// echo json_encode($outputArray);
}

function train_phrase($textFilePath) {
	// 	WORD2PHRASE tool v0.1a
	// Options:
	// Parameters for training:
	//         -train <file>
	//                 Use text data from <file> to train the model
	//         -output <file>
	//                 Use <file> to save the resulting word vectors / word clusters / phrases
	//         -min-count <int>
	//                 This will discard words that appear less than <int> times; default is 5
	//         -threshold <float>
	//                  The <float> value represents threshold for forming the phrases (higher means less phrases); default 100
	//         -debug <int>
	//                 Set the debug mode (default = 2 = more info during training)
	// Examples:
	// ./word2phrase -train text.txt -output phrases.txt -threshold 100 -debug 2

	$train = $textFilePath;
	$output = dirname ( __FILE__ ) . "/".basename($textFilePath, ".txt")."_vectors.bin";
	$min_count = 5;
	$threshold = 100;
	$debug = 2;
	
	exec ( "cd ".dirname ( __FILE__ )."/google-word2vec-trunk "
	."&& ./word2phrase -train {$train} -output {$output} "
	."-min-count {$min_count} "
	."-threshold {$threshold} "
	."-debug {$debug} "
	, $outputArray );

	//echo json_encode($outputArray);
}

function distance($binPath, $keyword) {
	// in case you want to debug gcc
	// exec ("cd " . dirname ( __FILE__ ) . " "
	// ."&& gcc ./distance.c -o distance -lm"
	// , $outputArray );

	exec ( "cd " . dirname ( __FILE__ ) . " "
	."&& ./distance {$binPath} {$keyword}"
	, $outputArray );

	if (isset ( $outputArray[0] )) {
		return $outputArray;
	} else {
		return array();
	}
}

function word_analogy($binPath, $keyword, $keyword2, $keyword3) {
	// in case you want to debug gcc
	// exec ("cd " . dirname ( __FILE__ ) . " "
	// ."&& gcc ./word-analogy.c -o word-analogy -lm"
	// , $outputArray );

	exec ( "cd " . dirname ( __FILE__ ) . " "
	."&& ./word-analogy {$binPath} {$keyword} {$keyword2} {$keyword3}"
	, $outputArray );

	if (isset ( $outputArray[0] )) {
		return $outputArray;
	} else {
		return array();
	}
}

function compute_accuracy($binPath, $threshold) {
	// 	Usage: ./compute-accuracy <FILE> <threshold>
	// where FILE contains word projections, and threshold is used to reduce vocabulary of the model for fast approximate evaluation (0 = off, otherwise typical value is 30000)

	exec ( "cd ".dirname ( __FILE__ )."/google-word2vec-trunk "
	."&& ./compute-accuracy {$binPath} {$threshold}"
	, $outputArray );

	if (isset ( $outputArray[0] )) {
		return $outputArray;
	} else {
		return array();
	}
}
?>
