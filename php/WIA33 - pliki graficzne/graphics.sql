-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Gru 2020, 18:16
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `graphics`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article`
--

CREATE TABLE `article` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `article`
--

INSERT INTO `article` (`id`, `header`) VALUES
(3, 'GIF'),
(4, 'JPG'),
(5, 'PNG'),
(6, 'SVG');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articlebody`
--

CREATE TABLE `articlebody` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_article` bigint(20) UNSIGNED DEFAULT NULL,
  `body` text NOT NULL,
  `rok` text NOT NULL,
  `typ` text NOT NULL,
  `size` text NOT NULL,
  `rodzaj` text NOT NULL,
  `transparent` text NOT NULL,
  `animacje` text NOT NULL,
  `zastosowanie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `articlebody`
--

INSERT INTO `articlebody` (`id`, `id_article`, `body`, `rok`, `typ`, `size`, `rodzaj`, `transparent`, `animacje`, `zastosowanie`) VALUES
(3, 3, 'Mówi się, że w tym formacie można użyć do 256 kolorów (lub 255 i jeden przezroczysty), lecz okazuje się to nieprawdą - podział obrazu na 9 bloków daje liczbę 1859 kolorów. Zatem 256 kolorów odpowiada jednym bloku. Obsługuje przezroczystość monochromatyczną, czyli każdy piksel może być przezroczysty. Większość programów do obróbki błędnie interpretuje format GIF, stąd ta niejasność. Do kompresji formatu używany jest algorytm LZW (Lempel-Ziv-Welch), bezstratny.', '1987', 'rastrowa', '88 KB', 'stratna', 'jest', 'jest', 'strony www, blogi, awatary, socialmedia'),
(4, 4, 'JPG wygyrwa w kategorii niewielkich rozmiarów plików, jednakże w niektórych przypadkach można zauważyć różnicę co do innych formatów. Przy kompresji, w zależności od wybranej jakości, dochodzi do strat, typu ostre krawędzie i jednolite barwy. Małe rozmiary przydają się do przechowywania dużych zbiorów obrazów w urządzeniach mobilnych, czy zewnętrznych. Występuje głębia kolorów do 24-bitów.', '1991', 'rastrowa', '60 KB', 'stratna', 'jest', 'jest', 'fotografia, strony www'),
(5, 5, 'Został stworzony przez ograniczenia związane z patentami w formacie GIF. PNG jest lepszą, wydajniejszą wersją GIF i JPG. Ma niewielkie rozmiary, a lepszą jakość w porównaniu do JPG. Mimo to większość programów nie radzi sobie z zapisywaniem do pliku PNG, np. powiększając rozmiar plików o zbędne dane. Głębia kolorów występuje na poziomie 48 bitów i jest możliwe użycie kanału alpha. Pliki PNG nie zapewniają obsługi kolorów CMYK.', '1995', 'rastrowa', '252 KB', 'stratna', 'jest', 'jest', 'fotografia, strony www'),
(6, 6, 'Format wektorowy 2D, stworzony głównie na potrzeby stron www. Przez swoją budowę (plik tekstowy XML) dużo bardziej nadaję się do tworzenia animacji niż inne formaty. Jest możliwość powięszkania obrazów bez utraty ich jakości. Możliwe jest ingerowanie w obraz SVG poprzez JS lub CSS. W SVG można opisywać również np. maski przezroczystości, filtry, gradienty.', '2001', 'rastrowa', '98 KB', 'stratna', 'jest', 'jest', 'grafika wektorowa, strony www, ikony, mapy, wykresy, loga, animacja');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `header` (`header`);

--
-- Indeksy dla tabeli `articlebody`
--
ALTER TABLE `articlebody`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `article`
--
ALTER TABLE `article`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `articlebody`
--
ALTER TABLE `articlebody`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `articlebody`
--
ALTER TABLE `articlebody`
  ADD CONSTRAINT `articlebody_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
