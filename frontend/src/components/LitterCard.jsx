export default function LitterCard({ litter, index, isUpcoming }) {
    return (
        <section
            className={`row align-items-center g-5 mb-5 py-4 ${index % 2 !== 0 ? 'flex-md-row-reverse' : ''}`}
        >
            <div className="col-md-6">
                <img
                    src={litter.image ? `http://localhost:8000/storage/${litter.image}` : 'https://placehold.co/600x400'}
                    alt={`Cucciolata ${litter.title}`}
                    className="img-fluid rounded shadow-sm w-100"
                    style={{ objectFit: 'cover', maxHeight: '400px' }}
                />
            </div>

            <div className="col-md-6">
                <h2 className="fw-bold text-uppercase mb-2">{litter.title}</h2>
                <h5 className="text-muted mb-3">{litter.father?.name} x {litter.mother?.name}</h5>

                <p className="text-secondary">
                    {litter.description}
                </p>

                <div className="border-top pt-3 mt-3 text-secondary">
                    <p className="mb-1 small"><strong>Padre:</strong> {litter.father ? ` ${litter.father.name} - ${litter.father.pedigree_code}` : ' Informazioni non disponibili'}</p>
                    <p className="mb-0 small"><strong>Madre:</strong> {litter.mother ? ` ${litter.mother.name} - ${litter.mother.pedigree_code}` : ' Informazioni non disponibili'}</p>
                </div>
            </div>
        </section>
    );
}