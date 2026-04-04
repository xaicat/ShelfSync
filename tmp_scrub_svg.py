import re
import os

def clean_svg(file_path):
    if not os.path.exists(file_path):
        print(f"File {file_path} not found.")
        return
    
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Remove all text elements that contain "D" and "IU"
    # Looking for: <text ...>...D...</tspan>...IU...</tspan></text>
    content = re.sub(r'<text[^>]*>.*?\bD\b.*?\bIU\b.*?</text>', '', content, flags=re.DOTALL)
    
    # Remove rectangles (the cls-4 ones that were used for the institutional logo)
    content = re.sub(r'<rect class="cls-4"[^>]*/>', '', content)
    
    # Remove any stray empty lines created
    content = re.sub(r'\n\s*\n', '\n', content)
    
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f"Cleaned {file_path}")

svg_files = [
    r'c:\xampp\htdocs\school_project\public\img\shelfsync.svg',
    r'c:\xampp\htdocs\school_project\resources\img\shelfsync.svg'
]

for f in svg_files:
    clean_svg(f)
