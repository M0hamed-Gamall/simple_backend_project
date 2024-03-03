fetch('server.php?user_notes', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json'
    }
  })
  .then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Handle the received data (user notes)
    console.log(data);
    // Example: Display the notes on the page

    data.forEach(note => {
        // Assuming there's an element with id "notes-container" where you want to display the notes
        document.getElementById('notes-container').innerHTML += `<div style="display:flex; gap:5px; align-items: center; justify-content: space-items; border: 1px solid black; padding: 10px; margin-bottom: 10px;"><p>${note.content}</p> <a href="index.php?dataUserID=${note.user_id}&dataNoteId=${note.note_id}">❌</a></div>`;
    });
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });
  
  