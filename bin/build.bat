@echo off
cd %~dp0
cd ..\database\php

REM Verifica se o executavel do PHP existe em PATH
where php >nul 2>nul
IF %ERRORLEVEL% EQU 0 (
    php deploy.php
) ELSE (
    C:\xampp\php\php.exe deploy.php
)
