<style>
    .story-chatbot {
        --chat-bg: #f8f3ea;
        --chat-panel: #ffffff;
        --chat-border: #e2d6c4;
        --chat-text: #332b21;
        --chat-muted: #7d7062;
        --chat-primary: #c9a96a;
        --chat-primary-dark: #b89250;
        --chat-shadow: 0 12px 26px rgba(0, 0, 0, 0.16);
        position: fixed;
        right: 94px;
        bottom: 30px;
        z-index: 995;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .story-chatbot * {
        box-sizing: border-box;
    }

    .story-chatbot .chat-toggle {
        width: 52px;
        height: 52px;
        border: none;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        background: linear-gradient(140deg, var(--chat-primary), var(--chat-primary-dark));
        box-shadow: var(--chat-shadow);
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .story-chatbot .chat-toggle:hover {
        transform: translateY(-4px);
    }

    .story-chatbot .chat-panel {
        position: absolute;
        right: 0;
        bottom: 66px;
        width: min(330px, 86vw);
        background: var(--chat-panel);
        border: 1px solid var(--chat-border);
        border-radius: 14px;
        box-shadow: var(--chat-shadow);
        overflow: hidden;
        display: none;
    }

    .story-chatbot.open .chat-panel {
        display: block;
    }

    .story-chatbot .chat-header {
        background: linear-gradient(120deg, #d2b47b 0%, #b89250 100%);
        color: #fff;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 600;
    }

    .story-chatbot .chat-header small {
        display: block;
        font-size: 11px;
        font-weight: 400;
        opacity: 0.9;
    }

    .story-chatbot .chat-body {
        padding: 10px;
        background: var(--chat-bg);
    }

    .story-chatbot .chat-messages {
        max-height: 270px;
        overflow-y: auto;
        padding-right: 2px;
    }

    .story-chatbot .msg {
        width: fit-content;
        max-width: 88%;
        margin-bottom: 8px;
        padding: 8px 10px;
        border-radius: 12px;
        line-height: 1.4;
        font-size: 13px;
        color: var(--chat-text);
        word-wrap: break-word;
    }

    .story-chatbot .msg.bot {
        background: #fff;
        border: 1px solid var(--chat-border);
        border-bottom-left-radius: 4px;
    }

    .story-chatbot .msg.user {
        margin-left: auto;
        background: var(--chat-primary);
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .story-chatbot .chat-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }

    .story-chatbot .chat-chip {
        border: 1px solid #d8cab6;
        background: #fff;
        color: #665847;
        border-radius: 999px;
        font-size: 11px;
        padding: 4px 8px;
        cursor: pointer;
    }

    .story-chatbot .chat-input-wrap {
        margin-top: 10px;
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .story-chatbot .chat-input {
        flex: 1;
        border: 1px solid var(--chat-border);
        border-radius: 8px;
        background: #fff;
        color: var(--chat-text);
        font-size: 13px;
        padding: 8px 10px;
        outline: none;
    }

    .story-chatbot .chat-input:focus {
        border-color: var(--chat-primary);
        box-shadow: 0 0 0 2px rgba(201, 169, 106, 0.15);
    }

    .story-chatbot .chat-send {
        border: none;
        border-radius: 8px;
        padding: 8px 10px;
        background: var(--chat-primary);
        color: #fff;
        cursor: pointer;
        font-size: 13px;
    }

    .story-chatbot .chat-note {
        margin-top: 8px;
        font-size: 11px;
        color: var(--chat-muted);
    }

    @media (max-width: 768px) {
        .story-chatbot {
            right: 94px;
            bottom: 30px;
        }

        .story-chatbot .chat-panel {
            right: 0;
            bottom: 64px;
            width: min(350px, calc(100vw - 24px));
        }
    }
</style>

<div class="story-chatbot" id="storyChatbot">
    <button class="chat-toggle" id="storyChatToggle" type="button" aria-label="Open gem and jewellery chatbot">
        <i class="fas fa-comments"></i>
    </button>

    <section class="chat-panel" aria-live="polite">
        <header class="chat-header">
            <div>
                Gem & Jewellery Assistant
                <small>Gem Story and Jewellery Story</small>
            </div>
            <button id="storyChatClose" type="button" aria-label="Close chatbot" style="border:none;background:transparent;color:#fff;cursor:pointer;font-size:16px;">
                <i class="fas fa-times"></i>
            </button>
        </header>

        <div class="chat-body">
            <div class="chat-messages" id="storyChatMessages"></div>
            <div class="chat-chips" id="storyChatChips"></div>
            <form class="chat-input-wrap" id="storyChatForm">
                <input class="chat-input" id="storyChatInput" type="text" placeholder="Ask about this page..." autocomplete="off">
                <button class="chat-send" type="submit"><i class="fas fa-paper-plane"></i></button>
            </form>
            <p class="chat-note">Answers are limited to Gem Story and Jewellery Story page details.</p>
        </div>
    </section>
</div>

<script>
    (function initStoryChatbot() {
        const widget = document.getElementById('storyChatbot');
        if (!widget || widget.dataset.inited === '1') return;
        widget.dataset.inited = '1';

        const toggleBtn = document.getElementById('storyChatToggle');
        const closeBtn = document.getElementById('storyChatClose');
        const form = document.getElementById('storyChatForm');
        const input = document.getElementById('storyChatInput');
        const messages = document.getElementById('storyChatMessages');
        const chipsWrap = document.getElementById('storyChatChips');

        const pagePath = window.location.pathname.toLowerCase();
        const pageKey = pagePath.includes('gemstory')
            ? 'gemstory'
            : (pagePath.includes('juwelerystory') || pagePath.includes('jewelerystory'))
                ? 'juwelerystory'
                : 'story';

        const normalizeText = (value) =>
            (value || '')
                .toLowerCase()
                .replace(/jewllery/g, 'jewellery')
                .replace(/jewelery/g, 'jewellery')
                .replace(/jewelry/g, 'jewellery')
                .replace(/gem catagories/g, 'gem categories')
                .replace(/gem category/g, 'gem categories')
                .replace(/navarathna/g, 'navaratna')
                .replace(/navaratna ring/g, 'navaratna')
                .replace(/catagories/g, 'categories')
                .replace(/catagory/g, 'category')
                .replace(/categories/g, 'category')
                .replace(/birth stones/g, 'birthstones')
                .replace(/birth stone/g, 'birthstone')
                .replace(/[^\w\s]/g, ' ')
                .replace(/\s+/g, ' ')
                .trim();

        const knowledge = {
            story: {
                intro: 'I can help with gem and jewellery topics such as Sri Lankan gemstone heritage, gem categories, jewellery types, and collections.',
                chips: ['Sri Lanka gems', 'Jewellery materials', 'Gem categories', 'Collections'],
                items: [
                    { keys: ['heritage', 'history', 'ratnapura', 'sri lanka'], answer: 'Sri Lanka is presented as a gem treasure island, with Ratnapura highlighted for centuries of gemstone mining and trade.' },
                    { keys: ['gem story', 'gems', 'gemstones', 'birthstone', 'birthstones'], answer: 'Gem Story covers mining, gem types, color groups, birthstones, ascendant gems, shapes and cuts, and navaratna traditions.' },
                    { keys: ['gem category', 'gem categories', 'gem catagories', 'categories'], answer: 'Gem categories are covered in the Gem Story page, where you can find types of gems, color groups, birthstones, and ascendant stones.' },
                    { keys: ['jewellery', 'craftsmanship', 'collections'], answer: 'Jewellery Story focuses on fine craftsmanship, materials, gemstone jewellery categories, jewellery types, and special collections.' },
                    { keys: ['gallery', 'images', 'visual'], answer: 'The sections use visual galleries to compare gemstone styles, jewellery designs, and curated collections.' },
                    { keys: ['what can you do', 'help', 'topics'], answer: 'I can explain gem history, mining, gemstone types, cuts, birthstones, jewellery materials, ring styles, and special collections from the Story pages.' }
                ]
            },
            gemstory: {
                intro: 'I can answer from Gem Story details: Sri Lanka gem heritage, Ratnapura mining, gem types, cuts, color categories, birthstones, ascendant stones, and navaratna.',
                chips: ['Ratnapura mining', 'Types of gems', 'Birthstones', 'Navaratna ring'],
                items: [
                    { keys: ['sri lanka', 'ratnapura', 'treasure island'], answer: 'Gem Story describes Sri Lanka as a gemstone treasure island and Ratnapura as the historic "City of Gems."' },
                    { keys: ['mining', 'illam', 'ngja', 'tools'], answer: 'Mining starts with land selection and legal approval (NGJA), then deep pit excavation to reach the gem-bearing "illam" layer for washing and sorting.' },
                    { keys: ['how are gems mined', 'gem mining process', 'mining process'], answer: 'Gem mining usually follows land selection, legal approval, digging to the illam layer, washing the gravel, and sorting the stones.' },
                    { keys: ['types', 'gem type', 'gem categories', 'gem category', 'alexandrite', 'ruby', 'sapphire', 'emerald', 'cat'], answer: 'It presents major gems including Blue Sapphire, Ruby, Emerald, Alexandrite, Amethyst, Diamond, Garnet, Jade, Yellow Sapphire, Spinel, and Cat\'s Eye.' },
                    { keys: ['shape', 'cut', 'round', 'oval', 'emerald cut', 'princess', 'marquise'], answer: 'Gem shapes and cuts include round, oval, marquise, pear, princess, cushion, emerald, baguette, heart, trilliant, cabochon, and briolette.' },
                    { keys: ['color', 'colour', 'red', 'blue', 'green', 'yellow', 'purple', 'white'], answer: 'Gemstones are grouped by color categories such as red, blue, green, yellow, purple, white/colorless, and multi-color changing stones.' },
                    { keys: ['birth', 'month', 'birthstone', 'birthstones'], answer: 'The Birthstones section maps each month to a gemstone, from January Garnet through December Tanzanite.' },
                    { keys: ['what is a birthstone', 'birthstone meaning', 'birthstones'], answer: 'A birthstone is a gemstone linked to a birth month and often chosen for personal meaning or gifting.' },
                    { keys: ['ascendant', 'zodiac', 'aries', 'taurus', 'planet'], answer: 'Ascendant gemstone guidance links zodiac signs and planets with stones like Red Coral, Diamond, Emerald, Yellow Sapphire, and Blue Sapphire.' },
                    { keys: ['what is ascendant gemstone', 'ascendant stone', 'zodiac gemstone'], answer: 'An ascendant gemstone is a stone associated with a zodiac sign or planet and is often worn for symbolic or astrological reasons.' },
                    { keys: ['navaratna', 'navarathna', 'nine gems'], answer: 'Navaratna explains the nine-gem planetary ring: Ruby, Pearl, Red Coral, Emerald, Yellow Sapphire, Diamond, Blue Sapphire, Hessonite, and Cat\'s Eye.' },
                    { keys: ['astrology', 'energy', 'lucky', 'planetary'], answer: 'Astrological sections describe gemstones as symbols of balance, protection, confidence, prosperity, and spiritual harmony.' }
                ]
            },
            juwelerystory: {
                intro: 'I can answer from Jewellery Story details: metal materials, gemstone jewellery categories, jewelry type categories, wedding pieces, men\'s jewelry, and special collections.',
                chips: ['Gold ring', 'Diamond ring', 'Wedding jewelry', 'Special collections'],
                items: [
                    { keys: ['gold ring', 'gold rings'], answer: 'Gold rings are timeless and durable, widely used for engagements, weddings, and daily elegance. They are available in yellow, white, and rose gold with common purity levels like 24K, 22K, and 18K.' },
                    { keys: ['diamond ring', 'diamond rings'], answer: 'Diamond rings symbolize love, strength, and commitment. They are popular for engagement and luxury styles because of their brilliance, durability, and timeless design.' },
                    { keys: ['gemstone ring', 'gemstone rings'], answer: 'Gemstone rings use stones such as sapphire, ruby, emerald, and amethyst set in gold, silver, or platinum. They are chosen for color, symbolism, astrology, and personal style.' },
                    { keys: ['navarathna ring', 'navaratna ring'], answer: 'Navarathna rings feature nine planetary gemstones and are worn for balance, protection, and prosperity while offering a vibrant multi-gem design.' },
                    { keys: ['what is a navaratna ring', 'navaratna meaning'], answer: 'A navaratna ring combines nine gemstones connected with planetary symbolism and is often worn for balance, protection, and positive energy.' },
                    { keys: ['birthstone ring', 'birth stone ring'], answer: 'Birthstone rings feature a gem linked to the birth month, making them meaningful gifts for birthdays, anniversaries, and personal milestones.' },
                    { keys: ['engagement ring', 'engagement rings'], answer: 'Engagement ring styles include solitaire, halo, three-stone, vintage style, and custom engagement rings. They represent lifelong commitment and are often set with diamond or precious gems.' },
                    { keys: ['solitaire ring', 'solitaire rings'], answer: 'Solitaire rings feature one center gemstone in a clean setting that highlights brilliance and timeless elegance.' },
                    { keys: ['halo ring', 'halo rings'], answer: 'Halo rings surround a center stone with smaller stones, adding extra sparkle and making the center gem appear larger.' },
                    { keys: ['three-stone ring', 'three stone ring'], answer: 'Three-stone rings symbolize past, present, and future, and are popular for engagement and anniversary jewelry.' },
                    { keys: ['vintage ring', 'vintage style ring'], answer: 'Vintage-style rings use classic motifs, delicate engravings, and antique-inspired settings for a romantic, timeless look.' },
                    { keys: ['wedding ring', 'wedding rings'], answer: 'Wedding rings are exchanged as symbols of lifelong unity and are commonly made in gold, platinum, or other durable precious metals.' },
                    { keys: ['bridal set', 'bridal sets'], answer: 'Bridal sets are coordinated pieces, often including necklace and earrings with optional bangles or bracelets, designed to complete wedding attire.' },
                    { keys: ['gold necklace', 'gold necklaces'], answer: 'Gold necklaces are classic pieces valued for lasting beauty and craftsmanship, suitable for both daily wear and ceremonies.' },
                    { keys: ['gemstone necklace', 'gemstone necklaces'], answer: 'Gemstone necklaces highlight stones like sapphire, ruby, emerald, and topaz, combining color, symbolism, and elegance.' },
                    { keys: ['diamond necklace', 'diamond necklaces'], answer: 'Diamond necklaces offer high brilliance and refined luxury, ideal for formal occasions and statement styling.' },
                    { keys: ['bracelet', 'bracelets', 'tennis bracelet'], answer: 'Bracelet options include gemstone, gold, silver, charm, tennis, adjustable, and men\'s bracelets for both casual and formal use.' },
                    { keys: ['earring', 'earrings', 'stud earrings', 'drop earrings', 'hoop earrings'], answer: 'Earring categories include studs, drops, hoops, chandbali, gemstone, bridal, and kids styles to match everyday and ceremonial wear.' },
                    { keys: ['pendant', 'pendants', 'initial pendant', 'heart pendant', 'zodiac pendant'], answer: 'Pendant options include gemstone, initial, religious, zodiac, heart, and custom name pendants for personalized styling and meaning.' },
                    { keys: ['bangle', 'bangles', 'kada', 'openable bangle'], answer: 'Bangle categories include gold, stone, bridal, openable, kada, and kids bangles, often worn individually or stacked.' },
                    { keys: ['mens ring', 'men ring', 'men\'s ring', 'mens jewelry', 'men jewelry'], answer: 'Men\'s jewelry includes rings, chains, bracelets, cufflinks, and pendants with bold and minimal styles.' },
                    { keys: ['bridal collection'], answer: 'The Bridal Collection emphasizes ceremonial elegance with coordinated gemstone and metal pieces crafted for wedding occasions.' },
                    { keys: ['astrology collection'], answer: 'The Astrology Collection uses planetary gemstones like ruby, sapphire, emerald, and yellow sapphire for symbolic and spiritual significance.' },
                    { keys: ['luxury collection'], answer: 'The Luxury Collection features premium gemstones and fine craftsmanship in high-end gold and platinum settings.' },
                    { keys: ['traditional collection'], answer: 'The Traditional Collection reflects South Asian heritage motifs, detailed gold work, and timeless ceremonial styling.' },
                    { keys: ['modern collection'], answer: 'The Modern Collection focuses on clean lines, lightweight structure, and contemporary everyday elegance.' },
                    { keys: ['limited edition'], answer: 'The Limited Edition Collection includes rare, small-batch designs with exclusive gemstone combinations and standout craftsmanship.' },
                    { keys: ['custom design', 'custom jewellery', 'custom jewelry'], answer: 'Custom design jewelry lets customers choose gemstone, metal, and setting to create one-of-a-kind personal pieces.' },
                    { keys: ['material', 'gold', 'silver', 'sterling', 'platinum', 'brass', 'copper', 'alloy'], answer: 'Materials include Gold, Sterling Silver, Platinum, Brass, Copper, and modern mixed alloys, each with different durability, style, and value.' },
                    { keys: ['category', 'gem category', 'precious', 'semi-precious', 'certified', 'birthstone'], answer: 'Gemstone jewelry categories include sapphire, ruby, emerald, navaratna, birthstone, diamond, pearl, semi-precious, precious collections, custom, and natural certified gemstones.' },
                    { keys: ['type', 'necklace', 'ring', 'earring', 'pendant', 'bangle', 'bracelet'], answer: 'Jewelry types cover rings, necklaces, bracelets, earrings, pendants, and bangles with many sub-types for daily wear and ceremonial use.' },
                    { keys: ['engagement', 'wedding', 'bridal', 'solitaire', 'halo'], answer: 'Engagement and wedding sections include solitaire, halo, three-stone, vintage, custom engagement rings, bridal sets, wedding rings, and traditional sets.' },
                    { keys: ['men', 'mens', 'cufflinks', 'chains'], answer: 'Men\'s jewelry includes rings, chains, bracelets, cufflinks, and pendants with bold, minimal, and modern styles.' },
                    { keys: ['special', 'luxury', 'modern', 'traditional', 'limited', 'custom design'], answer: 'Special collections include Bridal, Astrology, Luxury, Traditional, Modern, Limited Edition, and Custom Design Jewelry.' }
                ]
            }
        };
        const faqEntries = [
            { q: 'Why is Sri Lanka called the Treasure Island of Gemstones?', a: 'Sri Lanka is called the Treasure Island of Gemstones because it is famous for producing many valuable and beautiful natural gems.' },
            { q: 'Which city in Sri Lanka is famous for gem mining?', a: 'Ratnapura is the most famous gem-producing city in Sri Lanka.' },
            { q: 'What are the most popular gems found in Sri Lanka?', a: 'Blue Sapphire, Ruby, Emerald, Yellow Sapphire, and Cat\'s Eye are some of the most popular gems.' },
            { q: 'Why are Sri Lankan gems valuable?', a: 'Sri Lankan gems are valued for their beauty, color, clarity, rarity, and strong reputation worldwide.' },
            { q: 'What colors do gemstones come in?', a: 'Gemstones come in many colors such as blue, red, green, yellow, pink, purple, and white.' },
            { q: 'What is gem mining?', a: 'Gem mining is the process of digging and collecting gemstones from the earth.' },
            { q: 'Where does gem mining mainly happen in Sri Lanka?', a: 'Gem mining mainly happens in Ratnapura and other gem-rich regions.' },
            { q: 'What is illam in gem mining?', a: 'Illam is the gem-bearing gravel layer where gemstones are found.' },
            { q: 'Why do miners need permission before mining?', a: 'Miners need legal permission to follow safety, environmental, and mining regulations.' },
            { q: 'What happens after gems are mined?', a: 'They are washed, sorted, cut, polished, graded, and certified.' },
            { q: 'Why do rough gemstones look dull?', a: 'Rough gemstones look dull because they have not yet been cut and polished.' },
            { q: 'Why is cutting important for gems?', a: 'Cutting improves brilliance, sparkle, and overall beauty.' },
            { q: 'Why is polishing important for gems?', a: 'Polishing gives the gemstone shine and a smooth finished surface.' },
            { q: 'What is gemstone grading?', a: 'Gemstone grading is the evaluation of color, clarity, cut, and quality.' },
            { q: 'Why are gemstones certified?', a: 'Certification confirms authenticity and quality.' },
            { q: 'What is Alexandrite?', a: 'Alexandrite is a rare gemstone known for changing color in different lighting.' },
            { q: 'What does Alexandrite symbolize?', a: 'Alexandrite symbolizes transformation, balance, and good fortune.' },
            { q: 'What is Amethyst?', a: 'Amethyst is a purple quartz gemstone admired for its calming beauty.' },
            { q: 'What does Amethyst symbolize?', a: 'Amethyst symbolizes peace, clarity, and emotional balance.' },
            { q: 'Why are diamonds famous?', a: 'Diamonds are famous for their hardness, brilliance, and timeless beauty.' },
            { q: 'What do diamonds symbolize?', a: 'Diamonds symbolize love, strength, and eternity.' },
            { q: 'What is Garnet known for?', a: 'Garnet is known for its deep red color and fiery brilliance.' },
            { q: 'What does Garnet symbolize?', a: 'Garnet symbolizes passion, protection, and energy.' },
            { q: 'What is Jade?', a: 'Jade is a smooth and durable gemstone valued for beauty and cultural importance.' },
            { q: 'What does Jade symbolize?', a: 'Jade symbolizes purity, harmony, and protection.' },
            { q: 'Why is Ruby special?', a: 'Ruby is special for its rich red color, rarity, and royal history.' },
            { q: 'What does Ruby symbolize?', a: 'Ruby symbolizes passion, courage, and vitality.' },
            { q: 'What is Blue Sapphire known for?', a: 'Blue Sapphire is known for its deep royal blue color and brilliance.' },
            { q: 'What does Blue Sapphire symbolize?', a: 'Blue Sapphire symbolizes wisdom, loyalty, and protection.' },
            { q: 'What is Yellow Sapphire?', a: 'Yellow Sapphire is a bright golden gemstone valued for beauty and astrology.' },
            { q: 'What does Yellow Sapphire symbolize?', a: 'Yellow Sapphire symbolizes prosperity, wisdom, and abundance.' },
            { q: 'What is Spinel?', a: 'Spinel is a colorful gemstone admired for brilliance and variety of shades.' },
            { q: 'What is Cat\'s Eye?', a: 'Cat\'s Eye is a gemstone known for a bright band of light across its surface.' },
            { q: 'What does Cat\'s Eye symbolize?', a: 'Cat\'s Eye symbolizes protection, intuition, and good fortune.' },
            { q: 'What is Emerald?', a: 'Emerald is a precious green gemstone known for elegance and luxury.' },
            { q: 'What does Emerald symbolize?', a: 'Emerald symbolizes renewal, harmony, and prosperity.' },
            { q: 'What is the difference between gem shape and cut?', a: 'Shape is the outer outline, while cut is the way facets are arranged.' },
            { q: 'What is a Round cut?', a: 'Round cut is the most popular cut, known for maximum sparkle.' },
            { q: 'What is a Princess cut?', a: 'Princess cut is a square brilliant cut with sharp corners and high brilliance.' },
            { q: 'What is an Emerald cut?', a: 'Emerald cut is a rectangular step cut that highlights clarity and elegance.' },
            { q: 'What is an Oval cut?', a: 'Oval cut is an elongated brilliant cut with elegant sparkle.' },
            { q: 'What is a Cushion cut?', a: 'Cushion cut is a soft square or rectangle with rounded corners.' },
            { q: 'What is a Pear shape?', a: 'Pear shape is a teardrop-style gemstone cut with one rounded end and one point.' },
            { q: 'What is a Heart shape gemstone?', a: 'Heart shape is a romantic gemstone cut symbolizing love.' },
            { q: 'What is a Cabochon cut?', a: 'Cabochon cut is a smooth, rounded cut without facets.' },
            { q: 'What do red gemstones symbolize?', a: 'Red gemstones symbolize love, power, and passion.' },
            { q: 'What do blue gemstones symbolize?', a: 'Blue gemstones symbolize wisdom, peace, and loyalty.' },
            { q: 'What do green gemstones symbolize?', a: 'Green gemstones symbolize growth, harmony, and prosperity.' },
            { q: 'What do yellow gemstones symbolize?', a: 'Yellow gemstones symbolize success, positivity, and wealth.' },
            { q: 'What is a birthstone?', a: 'A birthstone is a gemstone connected to a person\'s birth month.' },
            { q: 'What is fine jewellery?', a: 'Fine jewellery is high-quality jewellery made with precious metals and gemstones.' },
            { q: 'Why is Sri Lanka known for jewellery?', a: 'Sri Lanka is known for jewellery because of its gemstones and skilled craftsmanship.' },
            { q: 'What materials are used in jewellery?', a: 'Gold, silver, platinum, brass, copper, and mixed alloys are commonly used.' },
            { q: 'Why is gold popular in jewellery?', a: 'Gold is popular because it is valuable, elegant, durable, and timeless.' },
            { q: 'What colors of gold are used in jewellery?', a: 'Yellow gold, white gold, and rose gold are common gold colors.' },
            { q: 'What do 24K, 22K, and 18K mean?', a: 'These indicate the purity level of gold used in jewellery.' },
            { q: 'What is sterling silver?', a: 'Sterling silver is 92.5% pure silver mixed with other metals for strength.' },
            { q: 'Why is sterling silver used in jewellery?', a: 'It is affordable, elegant, versatile, and suitable for daily wear.' },
            { q: 'What is platinum jewellery?', a: 'Platinum jewellery is luxury jewellery made from a rare, strong, naturally white metal.' },
            { q: 'Why is platinum used for engagement rings?', a: 'Platinum is durable and securely holds valuable gemstones.' },
            { q: 'What is brass jewellery?', a: 'Brass jewellery is made from copper and zinc and often has a warm golden tone.' },
            { q: 'Why is copper used in jewellery?', a: 'Copper is used for its rich color and handcrafted artistic appearance.' },
            { q: 'What are mixed metal alloys in jewellery?', a: 'Mixed alloys combine metals to improve durability, strength, and design flexibility.' },
            { q: 'What is sapphire jewellery?', a: 'Sapphire jewellery features blue sapphires in rings, earrings, necklaces, and other pieces.' },
            { q: 'What does sapphire jewellery symbolize?', a: 'Sapphire jewellery symbolizes wisdom, loyalty, and protection.' },
            { q: 'What is ruby jewellery?', a: 'Ruby jewellery features rich red gemstones used in elegant and luxurious designs.' },
            { q: 'What does ruby jewellery symbolize?', a: 'Ruby jewellery symbolizes passion, courage, and confidence.' },
            { q: 'What is emerald jewellery?', a: 'Emerald jewellery features green gemstones known for elegance and charm.' },
            { q: 'What does emerald jewellery symbolize?', a: 'Emerald jewellery symbolizes renewal, harmony, and wisdom.' },
            { q: 'What is Navarathna jewellery?', a: 'Navarathna jewellery includes nine gemstones representing planetary energies.' },
            { q: 'What is birthstone jewellery?', a: 'Birthstone jewellery features gemstones linked to a person\'s birth month.' },
            { q: 'Why is diamond jewellery popular?', a: 'Diamond jewellery is popular because of its brilliance, durability, and luxury appeal.' },
            { q: 'What is pearl jewellery known for?', a: 'Pearl jewellery is known for soft glow, elegance, and timeless beauty.' },
            { q: 'What is semi-precious gemstone jewellery?', a: 'It is jewellery made with gems like amethyst, garnet, topaz, and aquamarine.' },
            { q: 'What is custom gemstone jewellery?', a: 'Custom gemstone jewellery is designed according to a customer\'s preferred gem, metal, and style.' },
            { q: 'What are certified gemstones in jewellery?', a: 'Certified gemstones are lab-verified stones confirmed for authenticity and quality.' },
            { q: 'What are rings in jewellery?', a: 'Rings are jewellery pieces worn on fingers for fashion, symbolism, or commitment.' },
            { q: 'What are gemstone rings?', a: 'Gemstone rings are rings set with natural or precious stones.' },
            { q: 'What are diamond rings?', a: 'Diamond rings are rings featuring diamonds, often used for engagement or luxury wear.' },
            { q: 'What are couple rings?', a: 'Couple rings are matching or similar rings worn by partners.' },
            { q: 'What are statement rings?', a: 'Statement rings are bold rings designed to stand out.' },
            { q: 'What are necklaces?', a: 'Necklaces are jewellery pieces worn around the neck.' },
            { q: 'What are gemstone necklaces?', a: 'Gemstone necklaces are necklaces featuring stones like sapphire, ruby, or emerald.' },
            { q: 'What are bridal necklaces?', a: 'Bridal necklaces are necklaces designed for weddings and ceremonial wear.' },
            { q: 'What are layered necklaces?', a: 'Layered necklaces are multiple chains worn together for a stylish look.' },
            { q: 'What are bracelets?', a: 'Bracelets are jewellery pieces worn around the wrist.' },
            { q: 'What are charm bracelets?', a: 'Charm bracelets are bracelets with small symbolic decorative charms.' },
            { q: 'What are tennis bracelets?', a: 'Tennis bracelets are elegant bracelets with a continuous row of gemstones or diamonds.' },
            { q: 'What are earrings?', a: 'Earrings are jewellery pieces worn on the ears.' },
            { q: 'What are stud earrings?', a: 'Stud earrings are small earrings that sit directly on the ear.' },
            { q: 'What are hoop earrings?', a: 'Hoop earrings are circular or semi-circular earrings.' },
            { q: 'What are drop earrings?', a: 'Drop earrings hang below the earlobe and add graceful movement.' },
            { q: 'What are pendants?', a: 'Pendants are decorative jewellery pieces worn on a chain.' },
            { q: 'What are initial pendants?', a: 'Initial pendants display the first letter of a name as a personalized design.' },
            { q: 'What are zodiac pendants?', a: 'Zodiac pendants feature astrological sign symbols.' },
            { q: 'What are bangles?', a: 'Bangles are circular wrist jewellery pieces worn alone or stacked.' },
            { q: 'What are bridal bangles?', a: 'Bridal bangles are wedding bangles designed with traditional beauty and symbolism.' },
            { q: 'What is an engagement ring?', a: 'An engagement ring is a ring given as a symbol of love and marriage commitment.' },
            { q: 'What is wedding jewellery?', a: 'Wedding jewellery includes jewellery worn by the bride and groom during marriage ceremonies.' },
            { q: 'What are special jewellery collections?', a: 'Special jewellery collections are themed lines such as bridal, astrology, luxury, traditional, modern, and limited edition designs.' }
        ];

        const activeKnowledge = knowledge[pageKey];

        function addMessage(text, type) {
            const bubble = document.createElement('div');
            bubble.className = `msg ${type}`;
            bubble.textContent = text;
            messages.appendChild(bubble);
            messages.scrollTop = messages.scrollHeight;
        }

        function buildChips() {
            chipsWrap.innerHTML = '';
            activeKnowledge.chips.forEach((chipText) => {
                const chip = document.createElement('button');
                chip.type = 'button';
                chip.className = 'chat-chip';
                chip.textContent = chipText;
                chip.addEventListener('click', () => {
                    input.value = chipText;
                    form.dispatchEvent(new Event('submit', { cancelable: true }));
                });
                chipsWrap.appendChild(chip);
            });
        }

        function getReply(message) {
            const text = (message || '').trim().toLowerCase();
            if (!text) return 'Ask about gem or jewellery details, and I will answer from this page content.';
            if (/(hi|hello|hey)/.test(text)) return activeKnowledge.intro;
            const storeNamePattern = /pinw(an|wa|o)?tha\s+gems?\s*(?:&|and)?\s*j(e|ei|ew)w?e?l+l?e?r?y|pinw(an|wa|o)?tha\s+gems?|pinw(an|wa|o)?tha/i;
            if (storeNamePattern.test(text)) {
                return 'Pinwantha Gems & Jewellery is the official store behind this website, based in Pelmadulla, Rathnapura, Sri Lanka. If you need store help, product guidance, or contact details, please use the Contact page and our team will assist you.';
            }
            if (/\b(store|shop|showroom|branch|location|address|hours|opening|open|closed|availability|stock|price|pricing|buy|purchase|order|delivery|refund|return)\b/.test(text)) {
                return 'For store-related questions, please reach out through the contact form on the Contact page and our team will help you directly.';
            }

            const normalizedText = normalizeText(text);
            const faqExact = faqEntries.find((item) => normalizeText(item.q) === normalizedText);
            if (faqExact) return faqExact.a;

            const faqLoose = faqEntries.find((item) => {
                const normalizedQuestion = normalizeText(item.q);
                return normalizedText.length > 8 &&
                    (normalizedText.includes(normalizedQuestion) || normalizedQuestion.includes(normalizedText));
            });
            if (faqLoose) return faqLoose.a;

            const match = activeKnowledge.items
                .filter((item) => item.keys.some((key) => normalizedText.includes(normalizeText(key))))
                .sort((a, b) => {
                    const aMax = Math.max(...a.keys.map((k) => k.length));
                    const bMax = Math.max(...b.keys.map((k) => k.length));
                    return bMax - aMax;
                })[0];
            if (match) return match.answer;

            return 'I can answer gem and jewellery topics only. Try: "Ratnapura mining", "birthstones", "navaratna", "jewellery materials", or "wedding jewelry".';
        }

        toggleBtn.addEventListener('click', () => {
            widget.classList.toggle('open');
            if (widget.classList.contains('open')) input.focus();
        });

        closeBtn.addEventListener('click', () => {
            widget.classList.remove('open');
        });

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const userText = input.value.trim();
            if (!userText) return;

            addMessage(userText, 'user');
            input.value = '';

            window.setTimeout(() => {
                addMessage(getReply(userText), 'bot');
            }, 180);
        });

        addMessage(activeKnowledge.intro, 'bot');
        buildChips();
    })();
</script>
