import { Link } from 'react-router-dom';
export default function PuppyCard({ puppy, index }) {
    return (
        <section
            className={`row align-items-center g-5 mb-5 py-4 ${index % 2 !== 0 ? 'flex-md-row-reverse' : ''}`}
        >
            <div className="col-md-6">
                <img
                    src={puppy?.image ? `http://localhost:8000/storage/${puppy.image}` : 'https://placehold.co/600x400'}
                    alt={`Cucciolata ${puppy?.title}`}
                    className="img-fluid rounded shadow-sm w-100"
                    style={{ objectFit: 'cover', maxHeight: '400px' }}
                />
            </div>

            <div className="col-md-6">
                <h2 className="fw-bold text-uppercase mb-2">{puppy.name}</h2>
                <Link to={`/cucciolate/${puppy.litter.id}`} className="text-decoration-none text-dark" >
                    <h5 className="text-muted mb-3">{puppy.litter.title} </h5>
                </Link>

                <p className="text-secondary">
                    {puppy.description}
                </p>

                <div className="border-top pt-3 mt-3 text-secondary">
                    <Link to={`/i-nostri-cani/${puppy.litter.father?.id}`} className="text-decoration-none text-dark" >
                        <p className="mb-0 small"><strong>Padre:</strong> {puppy.litter.father ? ` ${puppy.litter.father.name} - ${puppy.litter.father.pedigree_code}` : ' Informazioni non disponibili'}</p>
                    </Link>
                    <Link to={`/i-nostri-cani/${puppy.litter.mother?.id}`} className="text-decoration-none text-dark" >
                        <p className="mb-0 small"><strong>Madre:</strong> {puppy.litter.mother ? ` ${puppy.litter.mother.name} - ${puppy.litter.mother.pedigree_code}` : ' Informazioni non disponibili'}</p>
                    </Link>
                </div>
            </div>
        </section >
    );
}