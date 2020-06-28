# Instrukcja uruchomienia pojektu
1.	***Instalacja XAMPP***
2.	***Konfiguracja XAMPP (włączenie Apache i MySQL)***
3.	***Konfiguracja pliku httpd-vhosts.conf***
 (zazwyczaj znajduje się on w takiej ścieżce - C:\xampp\apache\conf\extra)
Dodanie do końca pliku: 

><VirtualHost *:80>\
ServerName symfony.localhost\
 ServerAlias www.symfony.localhost \
DocumentRoot "C:/xampp/htdocs/symfony.localhost/public" \
 <Directory "C:/xampp/htdocs/symfony.localhost/public"> \
 	AllowOverride All \
	 Order Allow,Deny \
	 Allow from All \
 </Directory>\
ErrorLog "logs/symfony.localhost-error.log" \
 CustomLog "logs/symfony.localhost-access.log" common \
</VirtualHost>

![httpd-vhosts](./img/httpd-vhosts.png)

4.	***Dodawanie wpisu DNS*** – (zazwyczaj) w ścieżce C:\Windows\System32\drivers\etc\ otwieramy plik hosts i na końcu pliku dopisujemy: 
127.0.0.1 symfony.localhost

![hosts](./img/hosts.png)

5.	***Następnie po wpisaniu do pola przeglądarki adresu : symfony.localhost*** , powinna pojawić się strona.

Dodatkowo załączona jest eksportowana z phpMyAdmin baza danych używana do projektu. 
Aby wszystkie funkcje (w tym admina) były możliwe do przetestowania najlepiej zaimportować bazę (books.sql).
Przykładowi użytkownicy:
*	Admin:
	Email: admin@php.pl , hasło: admin
*	User:
	Email: manager1@php.pl , hasło: manager1

