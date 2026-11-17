<style>
    .sa-reveal-base {
        opacity: 0;
        transition: transform 0.8s ease, opacity 0.8s ease;
        will-change: transform, opacity;
    }

    .sa-from-left {
        transform: translateX(-56px);
    }

    .sa-from-right {
        transform: translateX(56px);
    }

    .sa-from-bottom {
        transform: translateY(52px);
    }

    .sa-visible {
        opacity: 1;
        transform: translate(0, 0);
    }

    @media (prefers-reduced-motion: reduce) {
        .sa-reveal-base,
        .sa-visible {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
</style>

<script>
    (() => {
        if (window.__siteScrollAnimationsInit) return;
        window.__siteScrollAnimationsInit = true;

        const addReveal = (el, direction, delay = 0) => {
            if (!el || el.classList.contains("sa-reveal-base")) return;
            el.classList.add("sa-reveal-base");
            el.classList.add(direction);
            el.style.transitionDelay = `${delay}ms`;
        };

        const pairContainerSelectors = [
            ".split-container",
            ".gem-story-container",
            ".jewelry-story-container",
            ".gem-types-container",
            ".gem-shapes-container",
            ".birth-container",
            ".ascendant-container",
            ".navaratna-ring-container",
            ".story-container",
            ".blog-row",
            ".birth-gem-row",
            ".color-row"
        ];

        document.querySelectorAll(pairContainerSelectors.join(",")).forEach((container) => {
            const children = Array.from(container.children).filter((node) => node.nodeType === 1);
            if (children.length < 2) return;
            addReveal(children[0], "sa-from-left", 20);
            addReveal(children[1], "sa-from-right", 120);
        });

        document.querySelectorAll("section div").forEach((container) => {
            if (container.children.length < 2 || container.children.length > 3) return;
            const kids = Array.from(container.children).filter((n) => n.nodeType === 1);
            const hasImage = kids.some((k) => /image/i.test(k.className));
            const hasText = kids.some((k) => /(content|text)/i.test(k.className));
            if (!hasImage || !hasText) return;
            addReveal(kids[0], "sa-from-left", 20);
            addReveal(kids[1], "sa-from-right", 120);
        });

        const cardSelectors = [
            ".gallery-item",
            ".details-card",
            ".asc-card",
            ".insight-card",
            ".navaratna-d-card",
            ".gemcat-item",
            ".special-modern-card",
            ".jtype-sub-item",
            ".faq-card",
            ".blog-card",
            ".sub-image",
            ".service-card",
            ".product-card",
            ".services-card",
            ".collection-card",
            ".feature-card",
            ".team-card",
            ".gem-details-anim"
        ];

        document.querySelectorAll(cardSelectors.join(",")).forEach((card, idx) => {
            const siblingCards = Array.from(card.parentElement?.children || []).filter(
                (el) => el.matches && cardSelectors.some((sel) => el.matches(sel))
            );
            const localIndex = Math.max(0, siblingCards.indexOf(card));
            const delay = (localIndex % 8) * 90;
            addReveal(card, "sa-from-bottom", delay || (idx % 8) * 90);
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("sa-visible");
                } else {
                    entry.target.classList.remove("sa-visible");
                }
            });
        }, { threshold: 0.16, rootMargin: "0px 0px -8% 0px" });

        document.querySelectorAll(".sa-reveal-base").forEach((el) => observer.observe(el));
    })();
</script>
