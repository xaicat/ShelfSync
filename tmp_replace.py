import os

filepath = r'c:\xampp\htdocs\school_project\resources\views\welcome.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

start = content.find('{{-- Laravel Logo --}}')
end = content.find('<div class="absolute inset-0', start)

if start != -1 and end != -1:
    new_logo = """{{-- ShelfSync Logo --}}
                    <img src="{{ asset('img/shelfsync.svg') }}" class="w-[80%] mx-auto mt-10 lg:mt-0 transition-all" alt="{{ config('app.name') }}">
                    """
    new_content = content[:start] + new_logo + content[end:]
    
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Welcome page updated successfully.")
else:
    print("Could not find the target strings in welcome.blade.php")
