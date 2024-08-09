<html>
<script>
// Disable right-click
document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});

// Disable F12 key and other DevTools shortcuts
document.addEventListener('keydown', function(e) {
    if (e.keyCode == 123) { // F12 key
        e.preventDefault();
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 73) { // Ctrl+Shift+I
        e.preventDefault();
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 74) { // Ctrl+Shift+J
        e.preventDefault();
    }
    if (e.ctrlKey && e.keyCode == 85) { // Ctrl+U
        e.preventDefault();
    }
});
</script>

</html>