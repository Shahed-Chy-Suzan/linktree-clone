require('./bootstrap');


$('.user-link').click(function(e) {
    // store the visit asynchronously without interrupting the link opening
    axios.post('/visit/' + $(this).data('link-id'), {
        link: $(this).attr('href')
    })
        .then(response => console.log('response: ', response))
        .catch(error => console.error('error: ', error));
});
