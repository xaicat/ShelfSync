import os

filepath = r'c:\xampp\htdocs\school_project\resources\views\user\index.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace CSS chunk
css_old = """        /* ── SEARCH BUTTON ───────────────────────────── */
        #nav-search-btn {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--surface); border: 1px solid var(--glass-border);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.4); font-size: 0.82rem; cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            flex-shrink: 0; margin-right: 8px;
        }
        #nav-search-btn:hover {
            background: var(--surface-hover);
            border-color: rgba(59,130,246,0.3);
            color: #fff;
            transform: scale(1.1);
            box-shadow: 0 0 16px rgba(59,130,246,0.2);
        }"""

js_old = """        // Inject search button
        if (navInner) {
            const searchBtn = document.createElement('button');
            searchBtn.id = 'nav-search-btn';
            searchBtn.setAttribute('aria-label', 'Search');
            searchBtn.innerHTML = '<i class="fas fa-search"></i>';
            const toggler = navInner.querySelector('.navbar-toggler');
            if (toggler) {
                navInner.insertBefore(searchBtn, toggler);
            } else {
                navInner.appendChild(searchBtn);
            }
            searchBtn.addEventListener('click', openSearch);
        }"""

js_new = """        // Setup search button
        const searchBtn = document.getElementById('nav-search-btn');
        if (searchBtn) {
            searchBtn.addEventListener('click', openSearch);
        }"""

if css_old in content:
    content = content.replace(css_old, "")
else:
    print("Could not find CSS block!")
    
if js_old in content:
    content = content.replace(js_old, js_new)
else:
    print("Could not find JS block!")

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated index.blade.php!")
