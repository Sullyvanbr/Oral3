SET NAMES utf8mb4;
USE nippon_map;

INSERT INTO places (name_place, japanese_name, emoji, category, lat, lon, `description`, is_suggested) VALUES
('Tokyo',      '東京',  '🗼', 'Ville',            35.676200, 139.650300, 'Capitale du Japon.', TRUE),
('Kyoto',      '京都',  '⛩️', 'Temple & Culture', 35.011600, 135.768100, 'L''ancienne capitale.', TRUE),
('Osaka',      '大阪',  '🏯', 'Gastronomie',      34.693700, 135.502300, 'Coeur gastronomique du Japon.', FALSE),
('Mont Fuji',  '富士山', '🗻', 'Nature',           35.360600, 138.727400, 'Le symbole du Japon, 3 776 m d''altitude.', TRUE),
('Sapporo',    '札幌',  '❄️', 'Ville',            43.061800, 141.354500, 'La ville du festival de neige d''Hokkaido.', FALSE),
('Hiroshima',  '広島',  '🎎', 'Ville',            34.385300, 132.455300, 'Ville symbole de paix et de résilience.', FALSE),
('Nara',       '奈良',  '🦌', 'Temple & Culture', 34.685100, 135.804800, 'Cerfs sacrés en liberté et Grand Bouddha.', TRUE),
('Fukuoka',    '福岡',  '🍜', 'Gastronomie',      33.590400, 130.401700, 'Le berceau du ramen Hakata.', TRUE),
('Arashiyama', '嵐山',  '🎋', 'Nature',           35.009400, 135.672800, 'La bambouseraie mythique de Kyoto.', TRUE),
('Okinawa',    '沖縄',  '🌺', 'Nature',           26.212400, 127.680900, 'Archipel tropical aux eaux turquoises.', FALSE);
