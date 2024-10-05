document.addEventListener('DOMContentLoaded', () => {
    const bookList = document.getElementById('book-list');
    const searchBox = document.getElementById('search-box');
  
    const books = [
      { title: 'Book One', author: 'Author One', category: 'Fiction' },
      { title: 'Book Two', author: 'Author Two', category: 'Non-Fiction' },
      { title: 'Book Three', author: 'Author Three', category: 'Science' }
    ];
  
    // Display all books
    const displayBooks = (filteredBooks) => {
      bookList.innerHTML = '';
      filteredBooks.forEach((book, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
          <div class="book-info">
            <strong>${book.title}</strong> by ${book.author} (Category: ${book.category})
          </div>
          <div class="actions">
            <button class="edit-btn" onclick="editBook(${index})">Edit</button>
            <button class="delete-btn" onclick="deleteBook(${index})">Delete</button>
          </div>
        `;
        bookList.appendChild(li);
      });
    };
  
    // Search books
    searchBox.addEventListener('input', (e) => {
      const searchText = e.target.value.toLowerCase();
      const filteredBooks = books.filter(book =>
        book.title.toLowerCase().includes(searchText) ||
        book.author.toLowerCase().includes(searchText) ||
        book.category.toLowerCase().includes(searchText)
      );
      displayBooks(filteredBooks);
    });
  
    // Functions for edit and delete (placeholder functions)
    window.editBook = (index) => {
      alert('Edit book: ' + books[index].title);
    };
  
    window.deleteBook = (index) => {
      alert('Delete book: ' + books[index].title);
    };
  
    // Display initial list of books
    displayBooks(books);
  });
  