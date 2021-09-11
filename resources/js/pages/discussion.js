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
                const voteup = item.getAttribute('data-vote-up');
                const votedown = item.getAttribute('data-vote-down');
                if (votedown) {
                    vote.innerHTML = parseInt(vote.innerHTML) + 1;
                    item.removeAttribute('data-vote-down');
                }
                if (!voteup) {
                    item.setAttribute('data-vote-up', 1);
                    btnUpvote.classList.add('text-blue-500');
                    btnDownvote.classList.remove('text-blue-500');
                    vote.innerHTML = parseInt(vote.innerHTML) + 1;
                    sendVote(id, 'upvote');
                } else {
                    item.removeAttribute('data-vote-up');
                    btnUpvote.classList.remove('text-blue-500');
                    vote.innerHTML = parseInt(vote.innerHTML) - 1;
                    sendVote(id, 'netral');
                }
            });
            if (btnDownvote) btnDownvote.addEventListener('click', function (e) {
                const voteup = item.getAttribute('data-vote-up');
                const votedown = item.getAttribute('data-vote-down');
                if (voteup) {
                    vote.innerHTML = parseInt(vote.innerHTML) - 1;
                    item.removeAttribute('data-vote-up');
                }
                if (!votedown) {
                    item.setAttribute('data-vote-down', 1);
                    btnDownvote.classList.add('text-blue-500');
                    btnUpvote.classList.remove('text-blue-500');
                    vote.innerHTML = parseInt(vote.innerHTML) - 1;
                    sendVote(id, 'downvote');
                } else {
                    item.removeAttribute('data-vote-down');
                    btnDownvote.classList.remove('text-blue-500');
                    vote.innerHTML = parseInt(vote.innerHTML) + 1;
                    sendVote(id, 'netral');
                }
            });
        }
    }
}

function sendVote(id, vote) {
    const url = window.location.href;
    const data = {
        id: id,
        vote: vote
    };
    fetch('api/discussion', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
}
