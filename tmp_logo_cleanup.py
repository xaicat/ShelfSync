import os

# 1. Clean index.blade.php (Remove Blobs)
index_path = r'c:\xampp\htdocs\school_project\resources\views\user\index.blade.php'
if os.path.exists(index_path):
    with open(index_path, 'r', encoding='utf-8') as f:
        lines = f.readlines()
    
    # Filter out the blob CSS block (approx 601-636) and JS block
    new_lines = []
    skip = False
    for line in lines:
        if '/* ══════════════ AMBIENT BLOBS ══════════════ */' in line:
            skip = True
        if skip and '/* ══════════════════════════════════════════' in line:
            skip = False
        
        if '/* ══════════════════════════════════════════\n           4. AMBIENT BLOBS' in line:
            skip = True
        if skip and '/* ══════════════════════════════════════════\n           5. CUSTOM CURSOR' in line:
            skip = False
            new_lines.append(line) # Keep the start of next section
            continue

        if not skip:
            new_lines.append(line)

    with open(index_path, 'w', encoding='utf-8') as f:
        f.writelines(new_lines)

# 2. Clean SVG (Remove DIU text and rects)
svg_paths = [
    r'c:\xampp\htdocs\school_project\public\img\shelfsync.svg',
    r'c:\xampp\htdocs\school_project\resources\img\shelfsync.svg'
]

for svg_path in svg_paths:
    if os.path.exists(svg_path):
        with open(svg_path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Remove DIU text
        content = content.replace('<text class="cls-5" transform="translate(21.37 368.32)"><tspan class="cls-2" x="0" y="0">D</tspan><tspan class="cls-1" x="190.26" y="0">IU</tspan></text>', '')
        # Remove rectangles
        content = content.replace('<rect class="cls-4" x="509.28" y="95.09" width="221.05" height="14.26"/>', '')
        content = content.replace('<rect class="cls-4" x="509.15" y="96.89" width="16.72" height="291.55"/>', '')
        
        with open(svg_path, 'w', encoding='utf-8') as f:
            f.write(content)

print("Blob purge and SVG cleanup successful.")
