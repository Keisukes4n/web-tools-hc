<?php
  /**
   * BASE64 Codec main process file
   * description: This file is called from index.php in front directory.
   */

  /** parameters */
  $name_process_base64  = 'encode-or-decode-base64';
  $name_textarea_base64 = 'input-string-base64';

  /** functions */
  function base64_build_date( $process, $input ) {
    $cnvrt_str = base64_process_string( $process, $input );
    $result    = base64_form_text( $cnvrt_str, $process, $input );
    return $result;
  }

  function base64_form_text( $cnvrt_str, $process, $input ) {
    $result = <<< "EOD"
    * Result
    {$cnvrt_str}
    * Coding process
    {$process} (Base64)
    * Input string
    {$input}
    EOD;
    return $result;
  }

  function base64_process_string( $process, $input ) {
    $result = null;
    switch ( $process ) {
      case 'encode':
        $result = base64_encode( $input );
        break;
      case 'decode':
        $result = base64_decode( $input );
        break;
    }
    return $result;
  }
?>

<form action="" class="base64-codec" id="formBase64Codec" method="POST">
  <input type="hidden" name="conversion-process" value="base64">

  <?php if ( isset( $_POST[$name_process_base64] ) && isset( $_POST[$name_textarea_base64] ) ): ?>
    <?php $base64_result = base64_build_date( $_POST[$name_process_base64], $_POST[$name_textarea_base64] ); ?>
    <section class="result-area" id="sectionResultArea">
      <h2>Result</h2>
      <textarea><?=htmlspecialchars( $base64_result, ENT_QUOTES );?></textarea>
    </section>
    <hr>
  <?php endif; ?>
  

  <section class="tile">
    <h2>1. Select "Encode" or "Decode" (base64)</h2>
    <div class="coding-process">
      <label>
        <input type="radio" name="<?=htmlspecialchars( $name_process_base64, ENT_QUOTES );?>" value="encode" required><span>Encode</span>
      </label>
      <label>
        <input type="radio" name="<?=htmlspecialchars( $name_process_base64, ENT_QUOTES );?>" value="decode"><span>Decode</span>
      </label>
    </div>
  </section>

  <section class="tile">
    <h2>2. Input text</h2>
    <textarea name="<?=htmlspecialchars( $name_textarea_base64, ENT_QUOTES );?>" placeholder="text" required></textarea>
    <button class="post" id="buttonPost" type="submit">Post!</button>
    <p>The result wiil be displayed after posted.</p>
  </section>
</form>

<?php unset( $name_process_base64, $name_textarea_base64 ) ?>

<?php /** a module file is end up here. : _base64.php */ ?>
