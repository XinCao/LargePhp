$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$.validator.addMethod("regex", function(value, element, regexp) {
      if (regexp.constructor != RegExp)
      {
        if(regexp.length < 2)
            return true;

          var startPos = regexp.indexOf('/');
          var lastPos = regexp.lastIndexOf('/');
          var pattern = regexp.substring(startPos + 1, lastPos);
          var modifiers = regexp.substring(lastPos + 1, regexp.length);

          regexp = new RegExp(pattern, modifiers);
      }
      else if (regexp.global)
      {
          regexp.lastIndex = 0;
      }
      return this.optional(element) || regexp.test(value);
  },
  "Please check your input."
);
