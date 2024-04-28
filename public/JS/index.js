function handleLogout(){
    fetch("{{ route('logout') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', // Assuming JSON data
            'X-CSRF-TOKEN': '{{ csrf_token }}' // Replace with your token generation method
        }
    })
    .then(response => {
        console.log(response);
    })
    .catch(error => {
        console.log(error);
    });
}
