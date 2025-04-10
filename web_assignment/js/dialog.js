function openDialog(contents, header = '') {
    if (header !== '') {
        let headerDiv = document.querySelector('.dialog-header');
        headerDiv.textContent = header;
    }
    let contentDiv = document.querySelector('.content');
    contentDiv.innerHTML = '';

    contents.forEach(text => {
        let p = document.createElement('p');
        p.textContent = text;
        contentDiv.appendChild(p);
    });

    document.querySelector('.dialog-container').style.display = 'flex';
}

function closeDialog() {
    document.querySelector('.dialog-container').style.display = 'none';
}


function openLogoutDialog() {
    let contentDiv = document.querySelector('.dialog-body .content');
    let p = document.createElement('p');
    p.textContent = 'Are you sure to logout? 😟';
    contentDiv.innerHTML = p.outerHTML;
    document.querySelector('.dialog').style.width = '25%';
    document.querySelector('.ok-btn').onclick = confirmLogout;
    document.querySelector('.cancel-btn').style.display = 'block';
    document.querySelector('.dialog-container').style.display = 'flex';
}

function confirmLogout() {
    window.location.href = "index.php?page=logout-complete";
}

function openDeleteDialog() {
    let contentDiv = document.querySelector('.dialog-body .content');
    let p = document.createElement('p');
    p.innerHTML = 'Are you sure to delete your account?<br>You can\'t undo this action! 😟';
    contentDiv.innerHTML = p.outerHTML;
    document.querySelector('.dialog').style.width = '25%';
    document.querySelector('.ok-btn').onclick = confirmDelete;
    document.querySelector('.cancel-btn').style.display = 'block';
    document.querySelector('.dialog-container').style.display = 'flex';
}

function confirmDelete() {
    document.querySelector('.dialog-container').style.display = 'none';
    window.location.href = "index.php?page=delete_account";
}
