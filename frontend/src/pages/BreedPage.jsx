import historyImg from '../assets/breed/historyImg.jpg'
import workImg from '../assets/breed/workImg.jpg'
import familyImg from '../assets/breed/familyImg.jpg'
import colorsImg from '../assets/breed/colorsImg.jpg'
import curiosityImg from '../assets/breed/curiosityImg.jpg'

export default function BreedPage() {
    return (
        <main className="bg-white text-dark min-vh-100 py-5 mt-5">
            {/* Page Title */}
            <section className="container mb-5 pt-4">
                <div className="row justify-content-center text-center">
                    <div className="col-lg-8">
                        <h1 className="display-4 fw-bold text-uppercase tracking-wide border-bottom pb-3 mb-3">
                            Il Pastore Australiano
                        </h1>
                        <p className="lead text-muted">
                            Scopri lo standard, la storia e le straordinarie sfumature di una razza unica.
                        </p>
                    </div>
                </div>
            </section>

            {/* Row 1: Storia e Origini (Immagine a Sinistra, Testo a Destra) */}
            <section className="container my-5 py-4">
                <div className="row align-items-center g-5">
                    <div className="col-md-6">
                        <img
                            src={historyImg}
                            alt="Cucciolo di Pastore Australiano"
                            className="img-fluid rounded shadow-sm w-100"
                            style={{ objectFit: 'cover', maxHeight: '400px' }}
                        />
                    </div>
                    <div className="col-md-6">
                        <span className="text-muted fst-italic d-block mb-1">Aussie</span>
                        <h2 className="fw-bold text-uppercase mb-3">Storia e Origini</h2>
                        <p className="small text-secondary mb-1"><strong>Origine:</strong> USA</p>
                        <p className="small text-secondary mb-3"><strong>Classificazione F.C.I.:</strong> Gruppo 1 – cani da pastore</p>
                        <p className="text-secondary">
                            Nel tardo 1800 gli antenati dei Pastori Australiani arrivarono negli stati occidentali a seguito dei pastori Baschi. Accompagnavano le greggi di pecore provenienti dall'Australia.
                        </p>
                        <p className="text-secondary">
                            I rancher americani ne apprezzarono immediatamente l'agilità e la straordinaria intelligenza. Il primo Club ufficiale di razza ASCA venne fondato successivamente nel 1957.
                        </p>
                    </div>
                </div>
            </section>

            {/* Row 2: Carattere (Testo a Sinistra, Immagine a Destra) */}
            <section className="container my-5 py-4">
                <div className="row align-items-center g-5 flex-md-row-reverse">
                    <div className="col-md-6">
                        <img
                            src={workImg}
                            alt="Pastore Australiano al lavoro con il bestiame"
                            className="img-fluid rounded shadow-sm w-100"
                            style={{ objectFit: 'cover', maxHeight: '400px' }}
                        />
                    </div>
                    <div className="col-md-6">
                        <span className="text-muted fst-italic d-block mb-1">Obbedienza</span>
                        <h2 className="fw-bold text-uppercase mb-3">Carattere</h2>
                        <p className="text-secondary">
                            Ottimi guardiani grazie al loro istinto protettore e spiccato senso territoriale, mostrano una totale devozione al padrone. Lavoratori instancabili e dotati di un'intelligenza straordinaria.
                        </p>
                        <p className="text-secondary">
                            L'Aussie moderno è un cane polivalente, ampiamente utilizzato in molte discipline sportive dalla conduzione delle greggi all'agility, l'obedience, fino alla pet therapy.
                        </p>
                    </div>
                </div>
            </section>

            {/* Row 3: Il Cane in Famiglia (Immagine a Sinistra, Testo a Destra) */}
            <section className="container my-5 py-4">
                <div className="row align-items-center g-5">
                    <div className="col-md-6">
                        <img
                            src={familyImg}
                            alt="Pastore Australiano in famiglia"
                            className="img-fluid rounded shadow-sm w-100"
                            style={{ objectFit: 'cover', maxHeight: '400px' }}
                        />
                    </div>
                    <div className="col-md-6">
                        <span className="text-muted fst-italic d-block mb-1">Vita Quotidiana</span>
                        <h2 className="fw-bold text-uppercase mb-3">Il cane in famiglia</h2>
                        <p className="text-secondary">
                            In ambito familiare sviluppa un legame simbiotico con tutti i componenti, mostrandosi particolarmente protettivo ed empatico. Ama partecipare a ogni attività della vita domestica.
                        </p>
                        <p className="text-secondary">
                            Essendo un cane molto ricettivo e dal forte dinamismo, adora i giochi all'aria aperta e necessita di sentirsi parte integrante del nucleo familiare, non tollerando l'isolamento prolungato.
                        </p>
                    </div>
                </div>
            </section>

            {/* Row 4: Aspetto Generale e Colori (Testo a Sinistra, Immagine a Destra) */}
            <section className="container my-5 py-4">
                <div className="row align-items-center g-5 flex-md-row-reverse">
                    <div className="col-md-6">
                        <img
                            src={colorsImg}
                            alt="Varietà di colori del Pastore Australiano"
                            className="img-fluid rounded shadow-sm w-100"
                            style={{ objectFit: 'cover', maxHeight: '400px' }}
                        />
                    </div>
                    <div className="col-md-6">
                        <span className="text-muted fst-italic d-block mb-1">Standard</span>
                        <h2 className="fw-bold text-uppercase mb-3">Aspetto Generale e Colori</h2>
                        <p className="text-secondary">
                            È un cane di media taglia, leggermente più lungo che alto, ben proporzionato, muscoloso ma agile. Lo standard ufficiale riconosce quattro manti fondamentali: Nero Tricolore, Rosso Tricolore, Blue Merle e Red Merle, che possono presentare sfumature bianche e focature.
                        </p>
                        <p className="text-secondary">
                            Gli occhi offrono uno sguardo magnetico e possono assumere tonalità che vanno dal marrone all'ambra, fino all'azzurro, manifestando frequentemente fenomeni di eterocromia.
                        </p>
                    </div>
                </div>
            </section>

            {/* Row 5: Curiosità (Immagine a Sinistra, Testo a Destra) */}
            <section className="container my-5 py-4">
                <div className="row align-items-center g-5">
                    <div className="col-md-6">
                        <img
                            src={curiosityImg}
                            alt="Particolare occhi Pastore Australiano"
                            className="img-fluid rounded shadow-sm w-100"
                            style={{ objectFit: 'cover', maxHeight: '400px' }}
                        />
                    </div>
                    <div className="col-md-6">
                        <span className="text-muted fst-italic d-block mb-1">Aneddoti</span>
                        <h2 className="fw-bold text-uppercase mb-3">Curiosità sulla razza</h2>
                        <p className="text-secondary">
                            In passato, i nativi americani consideravano questi cani sacri per via dei loro incredibili occhi azzurri, ribattezzandoli "Ghost Eyes" (occhi fantasma) e rispettandoli come creature mistiche.
                        </p>
                        <p className="text-secondary">
                            Inoltre, molti soggetti nascono con una coda naturalmente corta o assente, una caratteristica genetica nota come NBT (Natural Bobtail), perfettamente accettata dallo standard cinofilo.
                        </p>
                    </div>
                </div>
            </section>
        </main>
    );
}