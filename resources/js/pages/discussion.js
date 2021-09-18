import http from '../utils/http'

document.addEventListener('DOMContentLoaded', main);
function main() {
    // discussion
    if (document.querySelectorAll('.discussion-item').length > 0) {
        const items = document.querySelectorAll('.discussion-item');
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            const id = item.getAttribute('data-id');
            const btnUpvote = item.querySelector('.vote-up');
            const btnDownvote = item.querySelector('.vote-down');
            const vote = item.querySelector('.vote-count');
            if (btnUpvote) btnUpvote.addEventListener('click', function (e) {
                const dataVote = item.getAttribute('data-vote')
                if (dataVote === 'upvote') {
                    sendVote(id, 'unvote');
                    item.setAttribute('data-vote', 'false');
                    vote.innerHTML = parseInt(vote.innerHTML) - 1;
                    btnUpvote.classList.remove('text-blue-500');
                    btnDownvote.classList.remove('text-red-500');
                } else {
                    if (dataVote === 'downvote') vote.innerHTML = parseInt(vote.innerHTML) + 1;
                    sendVote(id, 'upvote');
                    item.setAttribute('data-vote', 'upvote');
                    vote.innerHTML = parseInt(vote.innerHTML) + 1;
                    btnUpvote.classList.add('text-blue-500');
                    btnDownvote.classList.remove('text-red-500');
                }
            });
            if (btnDownvote) btnDownvote.addEventListener('click', function (e) {
                const dataVote = item.getAttribute('data-vote')
                if (dataVote === 'downvote') {
                    sendVote(id, 'unvote');
                    item.setAttribute('data-vote', 'false');
                    vote.innerHTML = parseInt(vote.innerHTML) + 1;
                    btnDownvote.classList.remove('text-red-500');
                    btnUpvote.classList.remove('text-blue-500');
                } else {
                    if (dataVote === 'upvote') vote.innerHTML = parseInt(vote.innerHTML) - 1;
                    sendVote(id, 'downvote');
                    item.setAttribute('data-vote', 'downvote');
                    vote.innerHTML = parseInt(vote.innerHTML) - 1;
                    btnDownvote.classList.add('text-red-500');
                    btnUpvote.classList.remove('text-blue-500');
                }
            });
        }
    }
    // search
    if (document.querySelector('#forum-searchbox')) {
        const searchbox = document.querySelector('#forum-searchbox');
        const form = document.querySelector('form');
        const input = searchbox.querySelector('input');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const params = Object.fromEntries((new URLSearchParams(window.location.search)).entries())
            console.log(params);
        });
    }
}

function sendVote(id, vote) {
    const url = window.location.href;
    const params = {
        action: vote,
        discussion_id: id,
    };
    http({
        url: 'discussion/actions',
        method: 'GET',
        params
    });
}
