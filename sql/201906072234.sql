-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 07. Jun 2019 um 22:33
-- Server-Version: 10.1.40-MariaDB
-- PHP-Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `rezeptobot`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einheitenliste`
--

CREATE TABLE `einheitenliste` (
  `id` int(11) NOT NULL,
  `einheit` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `einheitenliste`
--

INSERT INTO `einheitenliste` (`id`, `einheit`) VALUES
(1, 'Stück(e)'),
(2, 'Dose(n)'),
(3, ' '),
(4, ' Gramm'),
(5, 'Zehe(n)'),
(6, 'Esslöffel'),
(7, 'Milliliter'),
(8, 'Teelöffel'),
(9, 'Messerspitze'),
(10, 'Prise'),
(11, 'Packung(en)'),
(12, 'Bund'),
(13, 'Tropfen'),
(14, 'Scheibe(n)');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `datum` varchar(10) NOT NULL,
  `rezept_id` int(11) NOT NULL,
  `titel` varchar(300) NOT NULL,
  `farbe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `event`
--

INSERT INTO `event` (`event_id`, `datum`, `rezept_id`, `titel`, `farbe`) VALUES
(1, '2019-04-10', 0, 'titel', 'red'),
(2, '2019-03-17', 0, 'titel', 'red'),
(3, '2019-03-17', 0, 'titel', 'red'),
(4, '2019-03-15', 0, 'Auswaerts', 'green'),
(5, '2019-03-11', 0, 'Essensbestellung', 'red'),
(6, '2019-03-01', 0, 'Alternativ: Fischstaebchen', 'yellow'),
(7, '2019-03-13', 0, 'Alternativ: Pommes', 'yellow'),
(8, '2019-01-09', 0, 'Essensbestellung', 'red'),
(9, '2019-03-10', 0, 'Alternativ: Brötchen', 'yellow'),
(10, '2019-05-09', 0, 'Alternativ: Fischstäbchen', 'yellow');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorienliste`
--

CREATE TABLE `kategorienliste` (
  `id` int(11) NOT NULL,
  `kategorie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `kategorienliste`
--

INSERT INTO `kategorienliste` (`id`, `kategorie`) VALUES
(1, 'Hauptgericht'),
(2, 'Nachspeise');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezept`
--

CREATE TABLE `rezept` (
  `id` int(11) NOT NULL,
  `titel` varchar(300) NOT NULL,
  `durchfuehrung` mediumtext NOT NULL,
  `anzahlPortionen` int(11) NOT NULL,
  `einheit` varchar(200) NOT NULL,
  `kochzeit` varchar(30) NOT NULL DEFAULT '0',
  `vorbereitungszeit` varchar(30) NOT NULL DEFAULT '0',
  `bildpfad` varchar(300) NOT NULL,
  `bildpfad_uebersicht` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rezept`
--

INSERT INTO `rezept` (`id`, `titel`, `durchfuehrung`, `anzahlPortionen`, `einheit`, `kochzeit`, `vorbereitungszeit`, `bildpfad`, `bildpfad_uebersicht`) VALUES
(24, 'Buntes Feta-Ofengemüse', '1. Ofen auf 180 Grad Ober- und Unterhitze vorheizen.<br/>2. Schafskäse in eine Auflaufform geben. Gemüse waschen, kleinschneiden und zu dem Käse in die Auflaufform geben.\r\n\r\n3. Gemüse mit etwas Öl beträufeln und mit Pfeffer, Salz und Kräutern würzen.\r\n\r\n4. Im Ofen für ca. 15 Minuten erhitzen.\r\n', 1, 'Portion(en)', '0', '0', 'images/IMG_0127.jpg', NULL),
(42, 'Spaghetti mit Tomaten - Thunfisch - Sahne - Soße', 'Den Knoblauch schälen und pressen. Die Zwiebeln in Würfel schneiden. Die Pepperoncini ebenfalls zerkleinern.\r\nDas Olivenöl in einen Topf geben und erhitzen. Anschließend den gepressten Knoblauch hinein geben und so lange anbraten, bis er bräunlich wird. Die Zwiebeln hinzugeben und leicht anbraten. Sind die Zwiebeln leicht glasig, den Thunfisch dazu, zerkleinern und mit anbraten. Die Pizzatomaten und die zerkleinerten Pepperoncini hinzu, gut umrühren und ca. 10 Minuten kochen lassen.\r\nDann die Sahne zufügen und mit Pfeffer und Salz abschmecken. Die Spaghetti al dente kochen, abseihen und mit etwas Olivenöl übergießen.', 4, 'Portion(en)', '10', '25', 'images/thun.jpg', NULL),
(45, 'Nudel - Kasseler - Pfanne mit Wirsing', 'Nudeln nach Packungsanweisung garen.\nKohl putzen und in Streifen schneiden. Zwiebel schälen und in feine Würfel schneiden. Kasseler waschen, trocken tupfen und in Würfel schneiden.\nÖl in einer großen Pfanne erhitzen, Kasseler darin rundherum kräftig anbraten. Zwiebel und Kohl zufügen. Gemüsebrühe zugießen und ca. 10 Minuten bei geschlossenem Topf garen.\n\nNudeln abgießen, unter den Kohl heben. Pfanne von der Platte ziehen. Senf und saure Sahne verrühren und unterheben. Mit Salz und Pfeffer abschmecken.\n', 2, 'Portion(en)', '10', '30', 'images/879716-420x280-fix-nudel-kasseler-pfanne-mit-wirsing.jpg', 'images/879716-420x280-fix-nudel-kasseler-pfanne-mit-wirsing700x350.jpg'),
(58, 'Zucchinikuchen mit Schokotropfen', 'Ofen auf 180° C (Umluft 160°C) vorheizen.\n\nZucchini grob raspeln. Mehl mit Natron, Backpulver, Nüssen und Zimt mischen.\nEier mit Öl und dem Zucker in einer Schüssel schaumig rühren. Dir Mehl Mischung nach und nach unterrühren.\nZucchini und Schokotropfen unterheben.\nDen Teig in die Form geben und im unteren Ofen Drittel 60-70Minuten backen.\n\nDen Kuchen 10 Minuten in der Form abkühlen lassen und dann auf ein Kuchengitter stürzen. Den vollständig erkalteten Kuchen mit der Glasur bestreichen.\n', 1, 'Portionen', '70', '20', 'images/605986-960x720-zucchinikuchen-mit-schokotropfen.jpg', NULL),
(60, 'Ananas-Kasseler mit Käsesoße', 'Die Butter schmelzen, den Schmelzkäse zugeben und rühren bis er auch geschmolzen ist. Danach Milch und Ananassaft unterrühren, vom Herd nehmen und dann die Sahne einrühren.\nDen Kasseler im Folienschlauch braten und auskühlen lassen, dann in Scheiben schneiden und in eine Auflaufform legen, darüber die Ananas und mit der Käsesoße übergießen.\n\nBei 200° ca. 45 Minuten überbacken.\n\nDazu Reis oder Spätzle.\n', 6, 'Portionen', '120', '30', 'images/82248-960x720-kasseler-mit-ananas-in-kaese-sosse.jpg', NULL),
(61, 'Banane-Nutella-Croissant', '1. Croissants-Teig ausbreiten und das breite Ende mit Nutella bestreichen.\n2. Banane in 4. Teile teilen.\n3. Banane in den Teig einwickeln und mit den Fingern verschließen.\n4. In Zimt und Zucker rollen.\n5. Nach Packungsanweisung im Ofen backen.', 1, 'Portionen', '0', '0', '', NULL),
(62, 'Apfel-Chia-Pudding', 'Chia-Samen und Haferflocken in eine Schale geben, mit dem Kokosdrink verrühren und einige Minuten Quellen lassen.\nIn der Zwischenzeit den Quark mit dem Joghurt cremig schlagen. Kiwi schälen und in Stücke schneiden, Apfel ebenfalls in Stücke schneiden.\nJoghurt-Quark über die Chia-Samen geben und mit dem Obst toppen.', 1, 'Portionen', '0', '15', '', NULL),
(63, 'Apfel-Muffins', 'Den Backofen auf 180°C (Umluft 160°C) vorheizen. 14 Papierbackförmchen in das Muffins-Blech setzen.\n\nÄpfel waschen, schälen, halbieren, entkernen und in Würfel schneiden. Mit Zitronensaft beträufeln. Das Mehl mit Backpulver vermengen. Das Ei verquirlen. Zucker, Vanillinzucker, Öl, Joghurt und Apfelwürfel mit dem Ei zur Mehlmischung geben. Den Teig in die Förmchen füllen und glatt streichen. Im Backofen ca. 30 Minuten backen.\n\nAnschließend die Muffins ca. 5 Minuten ruhen lassen, herausnehmen und abkühlen lassen.\n', 14, 'Portionen', '30', '0', '', NULL),
(64, 'Apfel-Nuss-Brot', 'Backofen auf 180°C Ober- und Unterhitze) vorheizen.\nDen geriebenen Apfel oder das Apfelmus mit den Eiern schaumig schlagen. Das Mehl und Backpulver sieben und mit den anderen Zutaten vermengen.\nIm Backofen 45 Minuten backen. Auf ein Gitter stürzen und abkühlen lassen.', 1, 'Portionen', '45', '15', '', NULL),
(74, 'Baguette Brötchen Low Carb', 'Backofen auf 200°C Ober-/Unterhitze vorheizen.\nDie Eier mit Wasser schaumig schlagen. Senf und Margarine unter rühren hinzugeben. Die trockenen Zutaten vermischen und nach und nach zur Ei-Mischung geben.\nAus dem entstanden Teig 2-4 längliche Brötchen formen, auf das Backblech legen und der länge nach einritzen.\n20 Minuten ruhen lassen.\n\nAuf mittlerer Schiene ca. 20Minuten backen, bis die Brötchen außen schön knusprig und leicht gebräunt sind.\n', 2, 'Portionen', '20', '15', '', NULL),
(75, 'Blumenkohl geröstet mit Spiegelei', 'Blumenkohl säubern, 10 Minuten in kaltem Salzwasser ziehen lassen und anschließend 15 Minuten köcheln lassen. Hähnchenbrust klein schneiden und mit dem Schinken im Öl anbraten. Danach rausnehmen und zur Seite Stellen.\n\nBlumenkohl abgießen und nach kurzem abkühlen in Röschen teilen, im Hähnchenfett anbraten und weiter zerkleinern. Fleisch und Schinken wieder dazugeben, mit Salz und Pfeffer würzen und den gehackten Schnittlauch darüberstreuen.\n\nZum Schluss zwei Spiegeleier braten.\n', 2, 'Portionen', '30', '10', '', NULL),
(76, 'Blumenkohl-Pizza', 'Einen Topf mit leicht gesalzenem Wasser zum kochen bringen und den Blumenkohl ca. 15min gar kochen. Wasser abgießen und den Blumenkohl mit einer Gabel zerkleinern. Ei, körnigen Frischkäse und das Mandelmehl unter den zerkleinerten Blumenkohl rühren und mit Salz abschmecken.\nBLumenkohlteig auf einem mit Backpapier ausgelegten Backblech gleichmäßig verteilen und für ca. 15-20 min bei 200grad Ober- und Unterhitze garen.\nIn der Zwischenzeit Rucola waschen und klein schneiden. Tomaten waschen und halbieren. Kochschinken in Streifen schneiden.\nTomatensoße auf dem Pizzaboden verteilen und mit Kochschinken , Tomaten und Rucola belegen.\n\nBelag kann je nach Geschmack geändert werden.\n', 1, 'Portionen', '20', '10', 'images/IMG_2265.jpeg', NULL),
(77, 'Brokkoli - Creme - Suppe', 'Brokkoli in Gemüsebrühe kochen bis er weich ist (frischen Brokkoli vorher waschen). Kartoffeln schälen und in Stücken geschnitten in Salzwasser weich kochen. Kartoffeln zu dem Brokkoli geben und pürieren.\n\nCrème Fraîche und Sahne unterrühren, mit Gewürzen abschmecken.\n', 4, 'Portionen', '20', '15', '', NULL),
(88, 'Brokkoli - Schinken - Quiche', 'Mehl, Salz, ein Ei und Butterflöckchen zu einem geschmeidigen Teig verarbeiten. Für etwa 30 Minuten den Teig im Kühlschrank ruhen lassen.\nDen Brokkoli waschen und in mundgerechte Stücke schneiden. Salzwasser zum Kochen bringen und die Röschen darin blanchieren.\nDen Schinken in kleine Würfel schneiden. Den Parmesan fein reiben. Die Eier leicht verquirlen. Die Sahne und etwa die Hälfte des Parmesans unterrühren. Alles kräftig mit Salz, Pfeffer und Muskat würzen.\nDen Backofen auf 200° C (Umluft 180 °C, Gas Stufe 3 ) vorheizen.\nDen Boden einer Quicheform (etwa 26 cm Durchmesser ) mit Backpapier auslegen und den Rand der Form mit etwas Butter einfetten.\nDen Teig ausrollen und so in die Form legen, dass Boden und Rand bedeckt sind. Den Teig leicht an den Rand drücken.\nDie Brokkoliröschen auf dem Teig verteilen. Dann die Schinkenwürfel gleichmäßig darauf geben und den Guss darüber gießen.\nDas ganze mit dem restlichen Parmesan bestreuen.\nDie Quiche auf zweitunterster Schien etwa 45 Minuten backen.', 4, 'Portionen', '45', '30', 'images/526586-420x280-fix-brokkoli-schinken-quiche.jpeg', 'images/526586-420x280-fix-brokkoli-schinken-quiche700x350.jpeg'),
(89, 'Brokkoli-Kartoffel-Gratin mit Schinken', 'Kartoffeln waschen, schälen, in Scheiben schneiden und in Salzwasser 10 min garen.\nDen Brokkoli waschen, schälen, in Röschen teilen und in kochendem Salzwasser in 8 min bissfest garen, in kaltem Wasser kurz abschrecken und in einem Sieb abtropfen lassen. damit er nicht weiter gart.\n\nIn der Zwischenzeit die Zwiebel und den Schinken klein schneiden und in einem Topf oder einer Pfanne in etwas Öl anschwitzen, 1 schwach gehäuften EL Mehl dazugeben, umrühren und die Sahne und die Milch dazugießen, weiter umrühren, aufkochen lassen und mit Salz, Pfeffer und Muskat abschmecken. Wenn die Soße zu dickflüssig wird, kann man noch etwas Brokkolisud dazugeben, oder auch Gemüsebrühe oder Wasser.\n\nBackofen auf 180 bis 200 Grad vorheizen.\n\nKartoffeln und Brokkoli in eine mit Öl ausgepinselte Auflaufform geben, die Schinken-Zwiebel-Sahne-Soße darüber gießen und den geriebenen Käse darauf verteilen. Ca. 20 min überbacken.\n', 4, 'Portionen', '20', '20', '', NULL),
(90, 'Bruschetta mit Tomaten und Knoblauch', 'Zuerst die Tomaten waschen, vom Grün befreien, halbieren und dann in kleine Würfel schneiden. Dann den Knoblauch sehr klein schneiden, zu den Tomatenstücken geben und mit gut 3 EL Öl sowie 1 - 2 TL Tomatengewürzsalz mischen. Unbedingt mindestens 2 Stunden im Kühlschrank ziehen lassen.\n\nDen Backofen auf 180 - 200 °C (Umluft) vorheizen, die Tomatenstücke aus dem Kühlschrank nehmen.\n\nDann das Ciabatta in ca. 1 cm dicke Scheiben schneiden und diese mit dem restlichen Öl beträufeln.\n\nBackpapier auf ein Backofengitter legen (wichtig) und die darauf ausgebreiteten Ciabattascheiben in der Mitte des Ofens goldfarben backen - nicht zu dunkel, sonst werden sie zu hart, das dauert 5 - 8 Minuten.\n\nDie Ciabattascheiben aus dem Ofen holen und mit den Tomaten-Knoblauch Gemisch belegen, 1/2 - 1 EL pro Scheibe.\n', 4, 'Portionen', '8', '20', 'images/1024268-960x720-bruschetta-mit-tomaten-und-knoblauch.jpg', NULL),
(91, 'Bunte Gemüsespaghetti mit Tofubolognese', '•Den Tofu mit den Händen zerbröseln. Knoblauch und Zwiebel pellen und in feine Würfel schneiden.\n• Öl in der Pfanne erhitzen. Tofu, Zwiebel und Knoblauch etwa 2 Minuten anbraten. Tomatenmark unterrühren und 1 Minute anrösten.\n• Mit den passierten Tomaten ablöschen, Kräuter sowie Gewürze hinzugeben und etwa 10 Minuten bei kleiner Hitze köcheln lassen. In der Zwischenzeit die Karotte schälen und die Zucchini waschen. Beides mit einem Spiralschneider oder alternativ mit einem Sparschäler in Streifen schneiden.\n• Einen Topf mit Wasser zum Kochen bringen und die Gemüsenudeln 2 bis 3 Minuten kochen. Anschließend abgießen, in einem Sieb abtropfen lassen und auf einen Teller geben. Die Soße darüber geben und genießen.', 1, 'Portionen', '0', '0', 'images/ZucchiniSpaghettiTofuBolog1.jpg', NULL),
(94, 'Cremige Hühnchen-Bacon-Pesto-Pasta in einem Topf', '1. In einem großen Topf bei mittlerer bis großer Hitze den Bacon knusprig braten.\n2. Hühnchen hinzufügen und mit Salz, Pfeffer und Knoblauchpulver würzen. So lange braten, bis es durch ist und dann aus dem Topf nehmen.\n3. Zwiebeln und Knoblauch hinzugeben.\n4. Wenn die Zwiebeln glasig sind, Spinat hinzufügen und erhitzen, bis er in sich zusammenfällt.\n5. Milch hinzufügen und zum Kochen bringen.\n6. Nudeln hinzufügen und bei geschlossenem Deckel kochen lassen.\n7. Die Nudeln bei mittlerer Hitze kochen, bis die Milch dicker wird und die Nudeln durch sind (ungefähr 7 Minuten).\n8. Das Hühnchen wieder hinzugeben. Pesto und Parmesan unterrühren.\n9. Mit Petersilie und Parmesan garnieren.\n10. Genießen!', 4, 'Portionen', '20', '30', 'images/original-16289-1483557703-2.jpg', NULL),
(95, 'Cake Pop', 'Butter, Zucker, Vanillezucker und Aroma verrühren bis es schaumig ist. Ei und Milch dazugeben.\nMehl und Backpulver vermischen, sieben und zur Masse dazugeben.\n\nTeig in die Form geben und bei 160°C 30 Minuten backen. Erst wenn abgekühlt aus der Form nehmen.\n\nKuvertüre schmelzen und die Pops damit überziehen. Nach Lust und Laune dekorieren.\n', 20, 'Stück', '30', '15', 'images/WhatsApp Image 2019-06-06 at 22.27.37.jpeg', NULL),
(96, 'Cannelloni mit Puten-Ziegenkäse-Füllung', 'Gemüse waschen, in grobe Stücke schneiden und grob hacken. Im Anschluss 4-5Minuten bissfest dämpfen.\n\nBackofen auf 200°C vorheizen. Ziegenfrschikäse zerdrücken und mit dem Gemüse vermischen, den Knoblauch dazupressen. Mit Salz und Pfeffer würzen.\n\nPutenbrustscheiben nebeneinander hinlegen und die Füllung in einem dicken Streifen an ein Ende der Putenbrustscheiben setzen und dann einrollen. Öffnung nach unten in eine Auflaufform geben.\n\nDie Cannelloni im Ofen ca. 25 Minuten backen.\n', 2, 'Portionen', '30', '20', 'images/24548-kuerbis-ricotta-cannelloni.jpg', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezept_kategorienliste`
--

CREATE TABLE `rezept_kategorienliste` (
  `id` int(11) NOT NULL,
  `rezept_id` int(11) NOT NULL,
  `kategorien_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `rezept_kategorienliste`
--

INSERT INTO `rezept_kategorienliste` (`id`, `rezept_id`, `kategorien_id`) VALUES
(1, 117, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezept_zutatenliste`
--

CREATE TABLE `rezept_zutatenliste` (
  `id` int(11) NOT NULL,
  `rezept_id` int(11) NOT NULL,
  `zutatenliste_id` int(11) NOT NULL,
  `anzahl` double(10,1) DEFAULT NULL,
  `einheit_id` int(11) NOT NULL,
  `zusatz` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rezept_zutatenliste`
--

INSERT INTO `rezept_zutatenliste` (`id`, `rezept_id`, `zutatenliste_id`, `anzahl`, `einheit_id`, `zusatz`) VALUES
(5, 24, 19, 4.0, 3, NULL),
(6, 24, 11, 1.0, 3, 'rot'),
(7, 24, 12, 150.0, 4, NULL),
(8, 24, 20, NULL, 3, NULL),
(9, 24, 17, NULL, 3, 'TK'),
(12, 42, 21, 2.0, 3, NULL),
(13, 42, 22, 2.0, 5, NULL),
(14, 42, 23, 1.0, 2, NULL),
(15, 42, 24, 1.0, 2, NULL),
(16, 42, 25, 1.0, 3, NULL),
(17, 44, 17, 4.0, 1, NULL),
(18, 44, 21, 4.0, 1, NULL),
(19, 44, 21, 442.0, 3, NULL),
(20, 44, 19, 4424.0, 5, NULL),
(21, 45, 27, 200.0, 4, NULL),
(22, 45, 11, 1.0, 3, NULL),
(23, 45, 30, 300.0, 4, NULL),
(24, 45, 20, 1.0, 6, NULL),
(25, 45, 31, 250.0, 7, NULL),
(26, 45, 33, 2.0, 3, NULL),
(27, 45, 29, 1.0, 3, NULL),
(28, 45, 15, NULL, 3, NULL),
(29, 45, 16, NULL, 3, NULL),
(31, 45, 32, NULL, 3, NULL),
(32, 0, 7, 4.0, 6, NULL),
(33, 57, 7, 3.0, 7, NULL),
(34, 58, 18, 1.0, 3, NULL),
(35, 58, 3, 250.0, 4, NULL),
(36, 58, 34, 2.0, 8, NULL),
(37, 58, 35, 1.0, 8, NULL),
(38, 58, 36, 1.0, 9, NULL),
(39, 58, 37, 200.0, 4, NULL),
(40, 58, 15, 1.0, 10, NULL),
(41, 58, 2, 3.0, 3, NULL),
(42, 58, 38, 150.0, 7, NULL),
(43, 58, 1, 180.0, 4, NULL),
(44, 58, 39, 10.0, 4, NULL),
(45, 58, 40, 100.0, 4, NULL),
(46, 58, 41, 150.0, 4, NULL),
(47, 60, 42, 125.0, 4, NULL),
(48, 60, 4, 125.0, 7, NULL),
(49, 60, 44, 65.0, 7, NULL),
(50, 60, 26, 185.0, 7, NULL),
(51, 60, 45, 1.0, 2, NULL),
(52, 61, 48, 1.0, 11, NULL),
(53, 61, 46, 1.0, 3, NULL),
(54, 62, 49, 1.0, 3, NULL),
(55, 62, 50, 3.0, 3, NULL),
(56, 62, 51, 50.0, 7, NULL),
(57, 62, 52, 150.0, 4, 'Alternativ Naturjoghurt'),
(58, 62, 53, 50.0, 4, NULL),
(59, 62, 54, 1.0, 3, NULL),
(60, 63, 55, 250.0, 4, NULL),
(61, 63, 56, 2.0, 6, NULL),
(62, 63, 3, 250.0, 4, NULL),
(63, 63, 34, 3.0, 8, NULL),
(64, 63, 2, 1.0, 3, NULL),
(65, 63, 1, 125.0, 4, NULL),
(66, 63, 39, 1.0, 11, NULL),
(67, 63, 38, 80.0, 7, NULL),
(68, 63, 57, 250.0, 4, NULL),
(69, 64, 55, 200.0, 4, 'alternativ Apfelmus'),
(70, 64, 2, 4.0, 3, NULL),
(71, 64, 58, 200.0, 4, 'alternativ anderes Vollkornmehl'),
(72, 64, 50, 50.0, 4, 'zart'),
(73, 64, 37, 50.0, 4, 'gemahlen'),
(74, 64, 34, 1.0, 8, NULL),
(75, 64, 36, 1.0, 8, NULL),
(76, 65, 45, 1.0, 2, NULL),
(77, 66, 45, 1.0, 6, NULL),
(78, 71, 34, 1.0, 11, 'voll'),
(79, 71, 34, 1.0, 11, 'voll'),
(80, 60, 30, 2.5, 3, 'ausgelöst'),
(83, 72, 45, 1.0, 2, ''),
(84, 73, 45, 1.0, 2, ''),
(85, 73, 45, 1.0, 2, ''),
(90, 60, 43, 2.5, 3, NULL),
(91, 62, 55, 0.5, 3, NULL),
(92, 61, 47, NULL, 3, NULL),
(93, 61, 1, NULL, 3, NULL),
(94, 61, 36, NULL, 3, NULL),
(95, 74, 2, 2.0, 3, ''),
(96, 74, 59, 115.0, 7, 'kochend'),
(97, 74, 32, 1.0, 3, 'mild'),
(98, 74, 60, 20.0, 3, 'geschmolzen'),
(99, 74, 61, 1.0, 6, 'alternativ Chia-Samen'),
(100, 74, 62, 120.0, 4, ''),
(101, 74, 34, 2.0, 8, ''),
(102, 75, 63, 1.0, 3, ''),
(103, 75, 2, 2.0, 3, ''),
(104, 75, 65, 70.0, 4, ''),
(105, 75, 66, 300.0, 4, ''),
(106, 75, 38, 2.0, 6, 'Rapsöl'),
(107, 75, 64, 2.5, 0, NULL),
(108, 75, 64, 0.5, 3, NULL),
(109, 75, 15, NULL, 3, NULL),
(110, 75, 16, NULL, 3, NULL),
(111, 76, 63, 250.0, 4, ''),
(112, 76, 67, 150.0, 4, 'alternativ Quark'),
(113, 76, 2, 1.0, 3, ''),
(114, 76, 62, 1.0, 3, 'alternativ Dinkelmehl'),
(115, 76, 68, 50.0, 7, ''),
(116, 76, 65, 50.0, 4, 'Kochschinken'),
(117, 76, 19, 5.0, 3, ''),
(118, 76, 70, 1.0, 3, 'Handvoll'),
(119, 77, 71, 750.0, 4, ''),
(120, 77, 31, 1.0, 3, ''),
(121, 77, 73, 3.0, 3, ''),
(122, 77, 74, 150.0, 7, ''),
(123, 77, 26, 150.0, 7, ''),
(124, 77, 15, NULL, 3, NULL),
(125, 77, 16, NULL, 3, NULL),
(127, 77, 75, NULL, 3, NULL),
(128, 86, 45, NULL, 3, ''),
(129, 87, 45, NULL, 3, ''),
(130, 87, 45, NULL, 3, ''),
(131, 88, 3, 250.0, 4, ''),
(132, 88, 2, 4.0, 3, ''),
(133, 88, 42, 125.0, 4, ''),
(134, 88, 71, 600.0, 4, ''),
(135, 88, 28, 50.0, 4, ''),
(136, 88, 65, 100.0, 4, 'gekocht'),
(137, 88, 26, 200.0, 7, ''),
(138, 88, 15, NULL, 3, ''),
(139, 88, 16, NULL, 3, ''),
(140, 88, 77, NULL, 3, ''),
(141, 89, 73, 800.0, 4, 'vorwiegend festkochend'),
(142, 89, 71, 400.0, 4, ''),
(143, 89, 65, 100.0, 4, 'gekocht'),
(144, 89, 26, 200.0, 7, ''),
(145, 89, 4, 200.0, 7, ''),
(146, 89, 15, NULL, 3, ''),
(147, 89, 16, NULL, 3, ''),
(148, 89, 77, NULL, 3, ''),
(149, 89, 11, 1.0, 3, ''),
(150, 89, 78, 100.0, 4, 'gerieben'),
(151, 90, 24, 5.0, 3, 'Fleisch- oder Strauchtomaten'),
(152, 90, 22, 2.0, 5, ''),
(153, 90, 20, 5.0, 6, ''),
(154, 90, 79, 2.0, 3, ''),
(155, 90, 15, NULL, 3, ''),
(156, 90, 16, NULL, 3, ''),
(157, 91, 80, 150.0, 4, 'oder Sojaschnitzel'),
(158, 91, 22, 1.0, 5, ''),
(159, 91, 11, 1.0, 3, ''),
(160, 91, 81, 1.0, 3, 'oder Rapsöl'),
(161, 91, 82, 1.0, 3, ''),
(162, 91, 68, 200.0, 4, 'mit Kräutern'),
(163, 91, 83, NULL, 3, ''),
(164, 91, 84, 1.0, 3, ''),
(165, 91, 18, 1.0, 3, ''),
(166, 24, 18, 0.5, 0, NULL),
(167, 24, 18, 0.5, 3, NULL),
(168, 24, 7, 150.0, 4, NULL),
(169, 24, 15, NULL, 3, NULL),
(170, 24, 16, NULL, 3, NULL),
(171, 0, 45, NULL, 3, ''),
(172, 0, 85, NULL, 3, ''),
(173, 0, 85, NULL, 3, ''),
(174, 0, 85, NULL, 3, ''),
(175, 0, 85, NULL, 3, ''),
(176, 0, 85, NULL, 3, ''),
(177, 0, 85, NULL, 3, ''),
(178, 0, 85, NULL, 3, ''),
(179, 0, 85, NULL, 3, ''),
(180, 0, 85, NULL, 3, ''),
(181, 0, 85, NULL, 3, ''),
(182, 0, 85, NULL, 3, ''),
(183, 93, 85, NULL, 3, ''),
(184, 94, 86, 6.0, 1, 'Streifen'),
(185, 94, 66, 2.0, 1, ''),
(186, 94, 11, 2.0, 3, ''),
(187, 94, 22, 4.0, 5, ''),
(188, 94, 88, 140.0, 4, 'Blattspinat'),
(189, 94, 4, 1200.0, 7, ''),
(190, 94, 27, 450.0, 4, 'Spaghetti'),
(191, 94, 89, 120.0, 4, 'grün'),
(192, 94, 28, 100.0, 4, ''),
(193, 95, 42, 75.0, 4, ''),
(194, 95, 1, 75.0, 4, ''),
(195, 95, 39, 1.0, 11, ''),
(196, 95, 91, 3.0, 13, ''),
(197, 95, 2, 1.0, 3, ''),
(198, 95, 4, 5.0, 6, ''),
(199, 95, 3, 150.0, 4, ''),
(200, 95, 90, 2.0, 6, ''),
(201, 95, 92, 150.0, 3, ''),
(202, 96, 93, 400.0, 4, 'gemischt'),
(203, 96, 94, 100.0, 4, 'alternativ Ricotta'),
(204, 96, 22, 1.0, 5, ''),
(205, 96, 95, 8.0, 13, ''),
(206, 96, 24, 200.0, 4, 'Dose, stückig'),
(207, 96, 17, NULL, 3, 'italienisch, TK'),
(208, 96, 96, 50.0, 4, 'alternativ Butterkäse'),
(209, 96, 15, NULL, 3, ''),
(210, 96, 16, NULL, 3, ''),
(211, 97, 85, NULL, 3, ''),
(212, 98, 85, NULL, 3, ''),
(213, 99, 85, NULL, 3, ''),
(214, 100, 85, NULL, 3, ''),
(215, 101, 85, NULL, 3, ''),
(216, 102, 85, NULL, 3, ''),
(217, 103, 85, NULL, 3, ''),
(218, 104, 85, NULL, 3, ''),
(219, 104, 85, NULL, 3, ''),
(220, 104, 85, NULL, 3, ''),
(221, 104, 85, NULL, 3, ''),
(222, 105, 85, NULL, 3, ''),
(223, 106, 85, NULL, 3, ''),
(224, 107, 85, NULL, 3, ''),
(225, 107, 85, NULL, 3, ''),
(226, 108, 85, NULL, 3, ''),
(227, 109, 85, NULL, 3, ''),
(228, 109, 85, NULL, 3, ''),
(229, 110, 85, NULL, 3, ''),
(230, 111, 85, NULL, 3, ''),
(231, 112, 85, NULL, 3, ''),
(232, 112, 85, NULL, 3, ''),
(233, 113, 85, NULL, 3, ''),
(234, 114, 85, NULL, 3, ''),
(235, 114, 85, NULL, 3, ''),
(236, 115, 85, NULL, 3, ''),
(237, 116, 85, NULL, 3, ''),
(238, 117, 85, NULL, 3, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutatenliste`
--

CREATE TABLE `zutatenliste` (
  `id` int(11) NOT NULL,
  `zutat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `zutatenliste`
--

INSERT INTO `zutatenliste` (`id`, `zutat`) VALUES
(1, 'Zucker'),
(2, 'Ei(er)'),
(3, 'Mehl'),
(4, 'Milch'),
(7, 'Champignon(s)'),
(11, 'Zwiebel(n)'),
(12, 'Feta'),
(15, 'Salz'),
(16, 'Pfeffer'),
(17, 'Kräuter'),
(18, 'Zucchini'),
(19, 'Kirschtomate(n)'),
(20, 'Olivenöl'),
(22, 'Knoblauch'),
(23, 'Thunfisch'),
(24, 'Tomate(n)'),
(25, 'Peperoni (scharf)'),
(26, 'Schlagsahne'),
(27, 'Nudeln'),
(28, 'Parmesan'),
(29, 'Wirsing'),
(30, 'Kasseler'),
(31, 'Gemüsebrühe'),
(32, 'Senf'),
(33, 'saure Sahne'),
(34, 'Backpulver'),
(35, 'Natron'),
(36, 'Zimt'),
(37, 'Haselnüsse'),
(38, 'Öl'),
(39, 'Vanillezucker'),
(40, 'Zartbitterschokolade'),
(41, 'Schokoglasur'),
(42, 'Butter'),
(43, 'Schmelzkäse'),
(44, 'Ananassaft'),
(45, 'Ananas'),
(46, 'Banane(n)'),
(47, 'Nutella'),
(48, 'Aufback-Croissants'),
(49, 'Chia-Samen'),
(50, 'Haferflocken'),
(51, 'Kokosdrink'),
(52, 'Sojajoghurt'),
(53, 'Magerquark'),
(54, 'Kiwi(s)'),
(55, 'Apfel/Äpfel'),
(56, 'Zitronensaft'),
(57, 'Naturjoghurt'),
(58, 'Dinkelvollkornmehl'),
(59, 'Wasser'),
(60, 'Margarine'),
(61, 'Flohsamenschalenmehl'),
(62, 'Mandelmehl'),
(63, 'Blumenkohl'),
(64, 'Schnittlauch'),
(65, 'Schinken'),
(66, 'Hähnchenbrustfilet'),
(67, 'Körniger Frischkäse'),
(68, 'passierte Tomaten'),
(69, 'Kirschtomate(n)'),
(70, 'Rucola'),
(71, 'Brokkoli'),
(72, 'Gemüsebrühe'),
(73, 'Kartoffel(n)'),
(74, 'Crème Fraîche'),
(75, 'Paprikapulver'),
(76, 'Parmesan'),
(77, 'Muskat'),
(78, 'Käse'),
(79, 'Ciabatta'),
(80, 'Tofuschnitzel'),
(81, 'Kokosöl'),
(82, 'Tomatenmark'),
(83, 'Basilikum'),
(84, 'Karotte(n)'),
(85, ' '),
(86, 'Bacon'),
(87, 'Knoblauchpulver'),
(88, 'Spinat'),
(89, 'Pesto'),
(90, 'Schokoraspel'),
(91, 'Vanillearoma'),
(92, 'Kuvertüre'),
(93, 'Gemüse'),
(94, 'Ziegenfrischkäsetaler'),
(95, 'Putenbrustaufschnitt'),
(96, 'Ziegenschnittkäse');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `einheitenliste`
--
ALTER TABLE `einheitenliste`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indizes für die Tabelle `kategorienliste`
--
ALTER TABLE `kategorienliste`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rezept`
--
ALTER TABLE `rezept`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rezept_kategorienliste`
--
ALTER TABLE `rezept_kategorienliste`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rezept_zutatenliste`
--
ALTER TABLE `rezept_zutatenliste`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `zutatenliste`
--
ALTER TABLE `zutatenliste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `einheitenliste`
--
ALTER TABLE `einheitenliste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `kategorienliste`
--
ALTER TABLE `kategorienliste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `rezept`
--
ALTER TABLE `rezept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT für Tabelle `rezept_kategorienliste`
--
ALTER TABLE `rezept_kategorienliste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `rezept_zutatenliste`
--
ALTER TABLE `rezept_zutatenliste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT für Tabelle `zutatenliste`
--
ALTER TABLE `zutatenliste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
