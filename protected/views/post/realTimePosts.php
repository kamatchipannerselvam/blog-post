<h2>📢 Live Blog Posts</h2>
<div id="postContainer">
    <p>Loading posts...</p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadPosts() {
    $.ajax({
        url: "<?php echo Yii::app()->createUrl('post/realTimePosts'); ?>",
        type: "GET",
        dataType: "json",
        success: function(posts) {
            let postHtml = "";
            if (posts.length === 0) {
                postHtml = "<p>No posts found.</p>";
            } else {
                posts.forEach(post => {
                    postHtml += `
                        <div class="post">
                            <h3>${post.title}</h3>
                            <p>${post.content.substring(0, 100)}...</p>
                            <a href="<?php echo Yii::app()->createUrl('post/view'); ?>?id=${post.id}">Read More</a>
                            <hr>
                        </div>
                    `;
                });
            }
            $("#postContainer").html(postHtml);
        },
        error: function() {
            $("#postContainer").html("<p>Error loading posts.</p>");
        }
    });
}

// Refresh posts every 5 seconds
setInterval(loadPosts, 5000);
$(document).ready(loadPosts);
</script>
