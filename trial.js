window.addEventListener('scroll', function() {
    // Get scroll position and height of the document
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    let documentHeight = document.documentElement.scrollHeight - window.innerHeight;
    
    // Calculate scroll percentage (0 to 1)
    let scrollPercent = scrollTop / documentHeight;
    
    // Scale the tree based on scroll position (min size 1, max size 2.5)
    let treeScale = 1 + scrollPercent * 1.5;
  
    // Calculate how much the tree should move vertically (from 0 to 200px)
    let treeMove = scrollPercent * 200; // Moves tree down by 200px max
    
    // Get the tree element
    let tree = document.querySelector('.tree');
    
    // Apply scale and movement (grow + move down)
    tree.style.transform = `scale(${treeScale}) translateY(${treeMove}px)`;
  
    // Optionally, change the image to show different stages of the tree
    if (scrollPercent > 0.5) {
      tree.style.backgroundImage = "url('tree.jpg')";  // Switch to full-grown tree
    } else {
      tree.style.backgroundImage = "url('sapling.jpg')"; // Show sapling
    }
  });


  window.addEventListener('scroll', function() {
    // Get the scroll position relative to the document height
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    let documentHeight = document.documentElement.scrollHeight - window.innerHeight;
    
    // Calculate the percentage of the page that has been scrolled
    let scrollPercent = scrollTop / documentHeight;
  
    // Convert the scroll percentage into a color change from brown to green
    let startColor = [139, 69, 19];  // RGB for brown
    let endColor = [0, 128, 0];      // RGB for green
  
    let r = Math.round(startColor[0] + (endColor[0] - startColor[0]) * scrollPercent);
    let g = Math.round(startColor[1] + (endColor[1] - startColor[1]) * scrollPercent);
    let b = Math.round(startColor[2] + (endColor[2] - startColor[2]) * scrollPercent);
  
    // Set the new background color
    document.body.style.backgroundColor = `rgb(${r},${g},${b})`;
  });
  
  