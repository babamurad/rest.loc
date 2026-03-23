
import json
import os

filepath = r'c:\OSPanel\domains\rest.loc\lang\ru.json'
with open(filepath, 'r', encoding='utf-8') as f:
    data = json.load(f)

unique_data = {}
for k, v in data.items():
    if k not in unique_data:
        unique_data[k] = v

with open(filepath, 'w', encoding='utf-8') as f:
    json.dump(unique_data, f, ensure_ascii=False, indent=4)
