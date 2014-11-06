jQuery(document).ready(function($){

  function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
  }

  // On key generator button click generate randomString() in target named input

  $('.keygen_js').click(function(){
    $target = $("[name=\""+ $(this).data('target') +"\"]");
    $target.val(randomString(65, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'));
  });

});
