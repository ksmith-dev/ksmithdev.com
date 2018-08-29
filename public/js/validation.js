$( document ).ready(function()
{
});

/*------------- KEEP OUTSIDE OF THE DOCUMENT.READY FUNCTION -------------*/
$('#form').validate
({
    rules: {
        email: {
            required: true,
            email: true
        },
        name: {
            required: true
        }
    },
    messages: {
      email: {
          required: 'please enter an email address',
          email: 'please enter a <i>valid </i> email address.'
      },
      name: {
          required: 'please enter your name'
      }
    }
});