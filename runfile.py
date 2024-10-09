import subprocess
import os

# Absolutong path ng mga files
base_path = r'C:\xampp\htdocs\webcare'
file1_path = os.path.join(base_path, 'app.py')  # Updated filename
file2_path = os.path.join(base_path, 'chatbot/app1.py')  # Updated filename

# Siguraduhin na ang mga files ay talagang nandiyan
assert os.path.isfile(file1_path), f"File not found: {file1_path}"
assert os.path.isfile(file2_path), f"File not found: {file2_path}"

# Patakbuhin ang unang file
p1 = subprocess.Popen(['python', file1_path], stdout=subprocess.PIPE, stderr=subprocess.PIPE)

# Patakbuhin ang pangalawang file
p2 = subprocess.Popen(['python', file2_path], stdout=subprocess.PIPE, stderr=subprocess.PIPE)

# Basahin ang output at error ng unang file
stdout1, stderr1 = p1.communicate()
print(f'File 1 output:\n{stdout1.decode()}')
if stderr1:
    print(f'File 1 errors:\n{stderr1.decode()}')

# Basahin ang output at error ng pangalawang file
stdout2, stderr2 = p2.communicate()
print(f'File 2 output:\n{stdout2.decode()}')
if stderr2:
    print(f'File 2 errors:\n{stderr2.decode()}')
