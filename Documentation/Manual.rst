############################
Formulare der SUB Goettingen
############################

Subforms ist eine Sammelstelle für Formulare, die mit Standardextensions wie powermail oder form nicht erstellt werden können.
Variable Daten wie Mailempfänger werden über TypoScript flexibel gesetzt.

*********************
Integrierte Formulare
*********************

Die Formulare sind jeweils als eigenständiges Plugin integriert.

====================
Bücherwunschformular
====================

Plugin Name: buecherwunsch

Das Bücherwunschformular bietet eine integrierte Zählung der bereits verschickten Mails und stellt diese im Subject dar.

Wird das Feld ISBN ausgefüllt, so wird über einen Ajax Call im Hintergrund eine Datenbank nach Metadaten für den Titel abgefragt und die Felder im Frontend bei Erfolgt damit gefüllt.
Sobald ein Titel gefunden wurde werden diese Metadaten in eine lokale Redis-Datenbank eingefügt und beim nächsten Abruf der ISBN stehen diese dann sofort lokal ohne API Anfrage direkt zur Verfügung

================
Feedbackformular
================

Pluginname: feedback

Ablösung der Extension nkwuserfeedback